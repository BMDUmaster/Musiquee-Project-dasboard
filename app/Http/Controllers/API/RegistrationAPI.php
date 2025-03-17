<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\APIMOdel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegistrationAPI extends Controller
{
  public function APIRegister(Request $request){
   $Validate = Validator::make($request->all(),[
    'Name'=>'required',
    'Email'=>'required|email|unique:api_registrations',
    'Phone'=>'required|unique:api_registrations|max:10|min:10'

   ]);
    if($Validate->fails()){
        return response()->json([
           "status"=> false,
           'Message'=>'Validation Failed',
           'error'=> $Validate->errors()->all()
        ],401);
    }

   $User = APIMOdel::create([
            'name'=>$request->Name,
            'email'=>$request->Email,
            'phone'=>$request->Phone,
            'address'=>$request->Address,

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

    ]);
  if($validate->fails()){
      return response()->json([
              'status'=>false,
              'Message'=>'Email Or Password is required',
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







