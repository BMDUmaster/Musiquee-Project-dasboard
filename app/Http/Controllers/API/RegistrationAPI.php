<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\APIMOdel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class RegistrationAPI extends Controller
{

  public function APIRegister(Request $request){
   $Validate = Validator::make($request->all(),[
    'name'=>'required',
    'email'=>'required|email|unique:api_registrations',
    'phone'=>'required|unique:api_registrations|max:10|min:10',
    'password'=>'required|min:5'
   ]);
    if($Validate->fails()){
        return response()->json([
           "status"=> false,
           'Message'=>'Validation Failed',
           'error'=> $Validate->errors()->all()
        ],401);
    }

   $User = APIMOdel::create([
            // dd('password'),

            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'password'=>Hash::make($request->password),

          ]);
          $token = $User->createToken('authToken')->plainTextToken;
    return response()->json([
        'status'=>true,
        'Message'=>'User Registered Successfully!',
        'user'=> $User,
        'token'=>$token
    ],201);

  }

 public function loginApi(Request $request){

    $validate = Validator::make($request->all(),[
        'email'=>'required_without:phone|email|exists:api_registrations,email',
        'phone' =>'required_without:email|digits:10|exists:api_registrations,phone',
        'password'=>'required|min:5'
    ]);
  if($validate->fails()){
      return response()->json([
              'status'=>false,
              'Message'=>'Email,Phone and  Password is required',
              'Error' => $validate->errors()->first()
      ],401);
  }
   $user = APIMOdel::where('email',$request->email)->orWhere('phone',$request->phone)->first();
   if (!$user) {
    return response()->json([
        'status' => false,
        'message' => 'User not found'
    ], 404);
}

  if(!$user|| !Hash::check($request->password,$user->password)){
    return response()->json(
        [
            'status'=>false,
            'password'=>'Invalid Password'
        ]
        );
  }
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ], 200);
    }

   //logout api



   public function logout(Request $request)
   {
       $user = Auth::guard('api')->user();
       if (!$user) {
           return response()->json(['status' => false, 'message' => 'User not logged in'], 401);
       }


       $user->tokens()->delete();

       return response()->json([
           'status' => true,
           'message' => 'Logout successful'
       ], 200);
   }

}







