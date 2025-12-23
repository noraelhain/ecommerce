<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email' =>['required','email','max:255'],
            'password' => ['required']
        ]);

        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'status' => false,
                'message' =>'invalid credentails'
            ]);
        }

        $user=Auth::user();

        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'successfuly',
            'data' => $user,
            'token' => $token
        ]);
    }

    public function register(Request $request){

        //1 validtion 
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','string','min:8','confirmed'],
            'avatar' =>['nullable','image','mimes:png,jpg,jpeg,webp,gif','max:2024']
        ]);

        //2 create data --> model ->create()
        $user= User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password)
        ]);

          if ($request->hasFile('avatar')) {
             $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        //3 token 
        $token=$user->createToken('auth_token')->plainTextToken;

        //4 response
        return response()->json([
            'status'=> true,
            'message' => 'create Account Done',
            'user'=>$user,
            'avatar_url' => $user->getAvatarUrl('avatar'),
            'token' =>$token,
        ]);


    }

    public function update(Request $request){
        $user=$request->user();

        $request->validate([
            'name' => ['sometimes','string','max:255'],
            'email' => ['sometimes','eamil'],
            'avatar' =>['sometimes','image','mimes:png,jpg,jpeg,webp,gif','max:2024']
        ]);

        $user=User::update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if ($request->hasFile('avatar')) {
             $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }


        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'=> true,
            'message' => 'create Account Done',
            'user'=>$user,
            'avatar_url' => $user->getAvatarUrl('avatar'),
            'token' =>$token,
        ]);


    }
 
    public function logOut(Request $request){
        // delete token for one device
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'=>true,
            'message'=>'logged Out ssuccessfuly'
        ]);

    }
    public function logOutAll(Request $request){

        // delete token for one device
        $request->user()->tokens()->delete();

        return response()->json([
            'status'=>true,
            'message'=>'logged Out ssuccessfuly'
        ]);

    }
    public function deleteAccount(Request $request){
        $user=$request->user();
        $user->delete();

        return response()->json([
            'status'=>true,
            'message'=> 'Account Deleted Successfuly'
        ]);

    }

}
