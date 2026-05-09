<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW PROFILE
    |--------------------------------------------------------------------------
    */

    public function show()
    {
        $user = Auth::user();

        return view('student.profile.show', compact('user'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT PROFILE FORM
    |--------------------------------------------------------------------------
    */

    public function edit()
    {
        $user = Auth::user();

        return view('student.profile.edit', compact('user'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'         => 'required|max:100',
            'phone'        => 'nullable|max:20',
            'institution'  => 'nullable|max:200',
            'cgpa'         => 'nullable|numeric|min:0|max:10',
            'bio'          => 'nullable|max:1000',
            'achievements' => 'nullable|max:2000',
            'photo'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'phone', 'institution', 'cgpa', 'bio', 'achievements']);

        /*
        |--------------------------------------------------------------------------
        | PHOTO UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            // Delete old photo
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $user->update($data);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }
}
