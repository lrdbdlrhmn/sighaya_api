<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class AuthController extends BaseController

{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'whatsapp' => 'required',
            'nni' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'notification_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError(__("auth.register_validation"), $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['headers'] =  ['authorization' => $user->createToken('MyApp')->plainTextToken];
        $success['result'] =  $user;
        $success['status'] =  'ok';
   
        return $this->sendResponse($success, __("auth.register_success"));
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        
        if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $update_notification_id = User::where('id',$user->id)->update(['notification_id' => $request->notification_id]);
            $success['result'] =  $user;
            $success['status'] =  'ok';
            $success['headers'] =  ['authorization' => $user->createToken('MyApp')->plainTextToken];
            return $this->sendResponse($success, __("auth.success"));
        } 
        else{ 
            return $this->sendError(__("auth.blocked"), ['error'=> $request->all()]);
        } 
    }
    public function logout() {
        //Auth::logout();
        $user = Auth::user(); 
        $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
        $success['phone'] =  $user->phone;
        $success['status'] =  'ok';
        $success['result'] = request()->user()->tokens()->delete();
        return $this->sendResponse(
            $success,
            __("auth.logout_success"),
        );
    }
    public function delete()
    {
        $user = User::find(Auth::user()->id);
        Auth::logout();
        if ($user->delete()) {
            # code...
            return $this->sendResponse(
                $success,
                __("auth.delete_success"),
            );
        }
        # code...
    }

    
}
