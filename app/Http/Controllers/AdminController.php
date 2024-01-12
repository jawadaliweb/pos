<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use app\Models\User;

class AdminController extends Controller

{
    public function AdminProfile() {
        $AdminData = Auth::user();

        return view('ProfileView', compact('AdminData'));

    }

    public function AdminProfileUpdate(Request $request) {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('photo')) {
            $this->deleteOldImage($user);

            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload'), $filename);

            $user->photo = $filename;
        }
        $user->save();
        if ($user->save()) {
            return redirect()->back()->with('success', 'updateded successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');

    }

    protected function deleteOldImage($user)
    {
        if ($user->photo) {
            $imagePath = public_path('upload') . '/' . $user->photo;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }

    public function ChangePassword() {

        return view('AdminChangePassword');
    }


    public function AdminPasswordUpdate(Request $request) {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required|same:newpassword',
        ]);

        if (password_verify($request->oldpassword, auth()->user()->password)) {
            auth()->user()->update(['password' => bcrypt($request->newpassword)]);
            return redirect('/dashboard')->with('success', 'Password updated successfully');
        }

        return redirect()->back()->with('error', 'Old password does not match');
    }

}
