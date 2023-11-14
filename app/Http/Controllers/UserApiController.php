<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserApiController extends Controller
{
    public function showUser($id=null){
        if($id==''){
            $users =User::get();
            return response()->json(['users'=>$users], 200);
        }else{
            $users = User::find($id);
            return response()->json(['users'=>$users],200);
        }
    }
    public function addUser(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
//            return $data;
            $rules =[
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6|max:12',
            ];
            $customMessage =[
                'name.required'=>'Name is Required',
                'email.required'=>'Email is Required',
                'email.email'=>'Email must be Valid.',
                'password.required'=>'Password is Required',

            ];

            $validator = Validator::make($data,$rules,$customMessage);
            if ($validator->fails()){
                return response()->json($validator->errors(),422);
            }


            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $msg = 'User add successfully';
            return response()->json(['msg'=>$msg],201);

        }
    }
//   multi user add for post
    public function addMultiUser(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
//            return $data;
            $rules =[
                'users.*.name'=>'required',
                'users.*.email'=>'required|email|unique:users',
                'users.*.password'=>'required',
            ];
            $customMessage =[
                'users.*.name.required'=>'Name is Required',
                'users.*.email.required'=>'Email is Required',
                'users.*.email.email'=>'Email must be Valid.',
                'users.*.password.required'=>'Password is Required',

            ];

            $validator = Validator::make($data,$rules,$customMessage);
            if ($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            foreach ($data['users'] as $adusers){
                $user = new User();
                $user->name = $adusers['name'];
                $user->email = $adusers['email'];
                $user->password = bcrypt($adusers['password']);
                $user->save();
                $msg = 'User add successfully';
            }
            return response()->json(['msg'=>$msg],201);
        }
    }
}
