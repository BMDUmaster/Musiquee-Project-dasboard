<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\userregister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class RegistrationAPI extends Controller
{

  public function APIRegister(Request $request){
   $Validate = Validator::make($request->all(),[
    // 'userName'=>'required',
    'email'=>'required_without:phone|email|unique:userregisters',
   'phone' => 'required_without:email|unique:userregisters|digits:10',
   'userName' => 'required_without_all:phone,email',
    // 'bio' => 'required',
    // 'socialLinks' => 'nullable|array',
    // 'socialLinks.*' => 'url',
//    'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    'password'=>'required|min:5'
   ]);
    if($Validate->fails()){
        return response()->json([
           "status"=> false,
           'Message'=>'Validation Failed',
           'error'=> $Validate->errors()->all()
        ],401);
    }

   $User = userregister::create([
            // dd('password'),

            'userName'=>$request->userName,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'bio'=>$request->bio,
            'socialLinks'=>json_encode($request->socialLinks),
            'profileImage'=>$request->profileImage,
            'password'=>Hash::make($request->password),

          ]);
          $token = $User->createToken('authToken')->plainTextToken;
    return response()->json([
        'status'=>true,
        'Message'=>'User Registered Successfully!',
        'user'=> $User,
        'Registration Token'=>$token
    ],201);

  }


  // login API

 public function loginApi(Request $request){

    $validate = Validator::make($request->all(),[
        'email'=>'required_without:phone|email|exists:userregisters,email',
        'phone' =>'required_without:email|digits:10|exists:userregisters,phone',
        'password'=>'required|min:5'
    ]);
  if($validate->fails()){
      return response()->json([
              'status'=>false,
              'Message'=>'Email or Phone and  Password is required',
              'Error' => $validate->errors()->first()
      ],401);
  }
   $user = userregister::where('email',$request->email)->orWhere('phone',$request->phone)->first();
   if (!$user) {
    return response()->json([
        'status' => false,
        'message' => 'User not found'
    ], 404);
}

  if(!$user||!Hash::check($request->password,$user->password)){
    return response()->json(
        [
            'status'=>false,
            'password'=>'Invalid Credentials'
        ]
        );
  }
        $token = $user->createToken('Login Token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'user' => $user,
            'Login Token' => $token
        ], 200);
    }

   //logout api
public function logout(Request $request)
{
    $user = Auth::user(); // Sanctum ke through user ko authenticate karenge

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'User not logged in'
        ], 401);
    }

    // User ke tokens ko delete karenge
    $user->tokens()->delete();

    return response()->json([
        'status' => true,
        'message' => 'Logout successful'
    ], 200);
}




public function editUser(Request $request)
{
    $getData = Auth::user();

    if (!$getData) {
        return response()->json([
            'status' => false,
            'message' => "User not logged in"
        ], 401);
    }

    $validate = Validator::make($request->all(), [
        'userName' => 'nullable|string|max:255',
        'bio' => 'nullable|string',
        'socialLinks' => 'nullable|array',
        'socialLinks.*' => 'url',
        'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($validate->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation Failed',
            'errors' => $validate->errors()->all()
        ], 401);
    }

    // Profile Image Upload
    if ($request->hasFile('profileImage')) {


        if ($getData->profileImage && file_exists(public_path($getData->profileImage))) {
            unlink(public_path($getData->profileImage));
        }


        $ProfileImage = $request->file('profileImage');
        $getExtension = $ProfileImage->getClientOriginalExtension();
        $changeName = time().'.'.$getExtension;
        $ProfileImage->move(public_path('/ProfileImage'), $changeName);

        $getData->profileImage = '/ProfileImage/'.$changeName;
    }


    $getData->update([
        'userName' => $request->userName ?? $getData->userName,
        'bio' => $request->bio ?? $getData->bio,
        'profileImage' => $getData->profileImage,
        'socialLinks' => $request->socialLinks ? json_encode($request->socialLinks) : $getData->socialLinks,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'User details updated successfully!',
        'user' => $getData
    ], 200);
}


public function UserDataGet(){
    $UserData = userregister::all();
    return view('User', compact('UserData'));

}


}





