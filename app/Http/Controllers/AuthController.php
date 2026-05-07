<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER AUTH (REGISTER WITH OTP)
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $otp = rand(100000, 999999);

        // store user data temporarily
        session([
            'register_data' => $request->only('name', 'email', 'password'),
        ]);

        // store OTP
        DB::table('otps')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5),
                'updated_at' => now(),
            ]
        );

        // send OTP email
        Mail::raw("Your FundNest OTP is: $otp", function ($msg) use ($request) {
            $msg->to($request->email)->subject('FundNest OTP Verification');
        });

        return redirect('/verify-otp')->with('success', 'OTP sent to your email');
    }

    /*
    |--------------------------------------------------------------------------
    | OTP VERIFICATION
    |--------------------------------------------------------------------------
    */

    public function showOtp()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $data = session('register_data');

        if (!$data) {
            return redirect('/register');
        }

        $record = DB::table('otps')
            ->where('email', $data['email'])
            ->first();

        if (!$record) {
            return back()->with('error', 'OTP not found');
        }

        if ($record->otp != $request->otp) {
            return back()->with('error', 'Invalid OTP');
        }

        if (now()->gt($record->expires_at)) {
            return back()->with('error', 'OTP expired');
        }

        // create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // cleanup
        DB::table('otps')->where('email', $data['email'])->delete();
        session()->forget('register_data');

        Auth::login($user);

        return redirect('/dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN / LOGOUT
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::logout();

        session()->forget('is_admin');
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login');
    }

    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD
    |--------------------------------------------------------------------------
    */

    public function showForgot()
    {
        return view('auth.forgot-password');
    }

    public function sendReset(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found');
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        $link = url('/reset-password/' . $token);

        Mail::raw("Reset your password: $link", function ($msg) use ($request) {
            $msg->to($request->email)->subject('FundNest Password Reset');
        });

        return back()->with('success', 'Reset link sent');
    }

    public function showReset($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->with('error', 'Invalid or expired token');
        }

        // expire after 60 mins
        if (now()->diffInMinutes($record->created_at) > 60) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return back()->with('error', 'Token expired');
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect('/login')->with('success', 'Password reset successful');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN AUTH
    |--------------------------------------------------------------------------
    */

    public function showAdminLogin()
    {
        return view('auth.admin');
    }

    public function adminLogin(Request $request)
    {
        if (
            $request->email === env('ADMIN_EMAIL') &&
            $request->password === env('ADMIN_PASSWORD')
        ) {
            session(['is_admin' => true]);

            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Invalid admin credentials');
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARDS
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        return view('dashboard');
    }

    public function adminDashboard()
    {
        if (!session('is_admin')) {
            return redirect('/admin/login');
        }

        return view('admin.admin_dashboard');
    }
}