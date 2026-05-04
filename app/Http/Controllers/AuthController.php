<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER AUTH
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
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
{
    Auth::logout(); // user logout

    session()->forget('is_admin'); // admin logout
    session()->invalidate();
    session()->regenerateToken();

    return redirect('/login');
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
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (
            $request->email === $email &&
            $request->password === $password
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