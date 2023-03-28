<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        if($request->post('contact_no')){
            $user = User::where('contact_no',$request->post('contact_no'))->first();
            if($user) {
                $user->type = 'old';
                $user->save();
                return response()->json(['message' => 'Your mobile number already exits','otp' => '1111','type' => $user->type], $this-> successStatus);
            }else{
                $validator = Validator::make($request->all(), [
                    'contact_no' => 'required|numeric|digits:10',

                ]);
                if ($validator->fails()) {
                    return response()->json(['error'=>$validator->errors()], 401);
                }
                $user = new User();
                $user->contact_no = $request->post('contact_no');
                $user->type = 'new';
                $user->save();
                return response()->json(['message' => 'Successfully Login','otp' => '1111','type' => $user->type], $this-> successStatus);
            }
        }
        else{
            return response()->json(['error'=>'Please Enter mobile no'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'pin_code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        if ($request->post('contact_no')) {
            $user = User::where('contact_no',$request->post('contact_no'))->first();
            if($user) {
                $user->name = $request->post('name');
                $user->email = $request->post('email');
                $user->pin_code = $request->post('pin_code');
                $user->save();
                return response()->json(['user'=> $user], $this-> successStatus);
            } else {
                return response()->json(['error'=>'Please Enter mobile no'], 401);
            }
        } else {
            $user = new User();
            $user->name = $request->post('name');
            $user->email = $request->post('email');
            $user->pin_code = $request->post('pin_code');
            $user->save();
            return response()->json(['success'=>$user], $this-> successStatus);
        }
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }
}
