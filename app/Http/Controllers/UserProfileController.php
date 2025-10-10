<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {
    $profile = UserProfile::firstOrNew(['user_id' => Auth::id()]);
    return view('profile.show', compact('profile'));
    }

    public function edit()
    {
        $profile = UserProfile::firstOrNew(['user_id' => Auth::id()]);
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'dob' => 'nullable|string|max:50',
            'gender' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:50',
            'about' => 'nullable|string',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|mimes:pdf|max:4096',
            'education' => 'nullable|string',
            'experience' => 'nullable|string',
            'skills' => 'nullable|string',
            'references' => 'nullable|string',
        ]);

        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $name = 'profile_' . Auth::id() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('profile_pics', $name, 'public');
            $data['profile_pic'] = 'storage/' . $path;
        }

        if ($request->hasFile('cv')) {
            $cv = $request->file('cv');
            $cvName = 'cv_' . Auth::id() . '_' . time() . '.' . $cv->getClientOriginalExtension();
            $cvPath = $cv->storeAs('cvs', $cvName, 'public');
            $data['cv'] = 'storage/' . $cvPath;
        }

        $profile = UserProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );
        return redirect()->route('profile.show')->with('success', 'Profile updated!');
    }
}
