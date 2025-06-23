<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function profile()
    {
        return view('user.setting.profile', ['page' => 'setting']);
    }

    public function profileUpdate(Request $request)
    {
        $user = $request->input('user');
        $profile = $request->input('profile');

        User::updateOrCreate(['id' => Cookie::get('id')], $user);
        Profile::updateOrCreate(['user_id' => Cookie::get('id')], $profile);

        return back()->with('success', 'Profile has been updated successfully.');
    }

    public function profileUpdatePassword(Request $request)
    {
        $user = User::find(Cookie::get('id'));
        $password = $request->input('user');

        if ($password['newPassword'] == $password['confirmPassword']) {
            if (Hash::check($password['currentPassword'], $user->password)) {
                $user->password = Hash::make($password['newPassword']);
                $user->save();
                return back()->with('success', 'Password has been changed successfully.');
            } else {
                return back()->with('error', 'Current password is incorrect.');
            }
        } else {
            return back()->with('error', 'Password confirmation does not match.');
        }
    }

    public function image()
    {
        return view('user.setting.image', ['page' => 'setting']);
    }

    public function imageUpdate(Request $request)
    {
        // Check if user uploaded a file
        if ($request->hasFile('photoProfile')) {

            // Get the uploaded file
            $file = $request->file('photoProfile');

            // Check file format (must be PNG or JPEG)
            $allowedExtensions = ['png', 'jpeg', 'jpg'];
            if (!in_array($file->extension(), $allowedExtensions)) {
                return back()->with('error', 'The file must be in PNG or JPEG format.');
            }

            // Generate a filename
            $filename = "profile-photo-" . time() . '.' . $file->extension();

            // Store the file
            $file->storeAs('public/photo-profile', $filename);

            // Update user's profile
            Profile::where('user_id', Cookie::get('id'))->update(['photoProfile' => $filename]);

            // Return success message
            return back()->with('success', 'Profile photo uploaded successfully.');
        }

        return back()->with('error', 'Upload error. Please try again.');
    }
}
