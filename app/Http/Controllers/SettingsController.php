<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileValidationRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JD\Cloudder\Facades\Cloudder;

class SettingsController extends Controller
{
    public function index()
    {
        return view('author.settings');
    }

    public function updateProfile(ProfileValidationRequest $request)
    {
        try {
            $image = $request->file('image');
            $user = Auth::user();
            if (isset($image)) {
                // CLOUDINARY UPLOAD
                $upload = Cloudder::upload($image, 'profiles/' . $image)->getResult();

                if ($upload) {
                    // delete old image when image_id NOT NULL
                    if (null != $user->image_id) {
                        Cloudder::delete($user->image_id);
                    }
                    // assign new image
                    $image_id = $upload['public_id'];
                    $image_url = $upload['url'];
                } else {
                    Toastr::error('Upload image failed!', 'Error');

                    return back();
                }
            } else {
                $image_url = $user->image;
                $image_id = null;
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->image_id = $image_id;
            $user->image = $image_url;
            $user->about = $request->about;
            $user->update();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong!', 'Error');

            return back();
        }

        Toastr::success('Profile Successfully Updated :)', 'Success');

        return back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        try {
            $hashedPassword = Auth::user()->password;
            if (Hash::check($request->old_password, $hashedPassword)) {
                if (!Hash::check($request->password, $hashedPassword)) {
                    $user = User::find(Auth::id());
                    $user->password = Hash::make($request->password);
                    $user->update();
                    Toastr::success('Password Successfully Changed', 'Success');
                    Auth::logout();

                    return redirect()->route('login');
                }
                Toastr::error('New password cannot be the same as old password.', 'Error');

                return back();
            }
            Toastr::error('Current password not match.', 'Error');

            return back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong!', 'Error');

            return back();
        }
    }
}
