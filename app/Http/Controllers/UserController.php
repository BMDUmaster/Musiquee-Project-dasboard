<?php

namespace App\Http\Controllers;

use App\Models\UserRegistration;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserRegistration(){

        $getUser = UserRegistration::all();
        return view('User',compact('getUser'));
    }

    public function UserdataUpload(Request $request){

        // ✅ Validate Request Data
        $request->validate([
            'name'=>'required',
            'username'=>'required|unique:user_registrations',
            'phone'=>'required|max:10|min:10|unique:user_registrations',
            'email'=>'required|email|unique:user_registrations,email',
            'password'=>'required|min:6|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&]{2,}).{8,}$/',
            'profile_image'=>'required|mimes:jpg,png,gif,jpeg|max:2048'
        ],[
            'password.required' => 'Password field is required.',
            'password.min' => 'Password must be at least six characters.',
            'password.regex' => 'Password must contain at least one letter, one number, and at least two special symbols (!,@,#,$,%,^,&,*).'
        ]);

        // ✅ Handle Profile Image Upload
        $NewFileName = "default.jpg"; // Default image if not uploaded
        if($request->hasFile('profile_image')){
            $getFile = $request->file('profile_image');
            $getExtension = $getFile->getClientOriginalExtension();
            $NewFileName = time().".".$getExtension;
            $getFile->move(public_path('UserProfile'), $NewFileName);
        }

        // ✅ Store User Data
        $UserModel = new UserRegistration;
        $UserModel->Name = $request->name;
        $UserModel->UserName = $request->username;
        $UserModel->Phone = $request->phone;
        $UserModel->email = $request->email;
        $UserModel->Password = Hash::make($request->password); // 🔥 Fixed Here
        $UserModel->file = $NewFileName;
        $UserModel->save();

        return redirect()->back()->with('success','Your Profile is successfully Updated');
    }
}
