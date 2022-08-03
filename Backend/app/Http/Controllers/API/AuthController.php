<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
   
class AuthController extends BaseController
{
    public function signin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $authUser = Auth::user(); 
            $success['token'] =  $authUser->createToken('OwzXQ%xm9gEwJI^w*1yBkoznfQRtIFlVW&#s0%np3@8NJl8vQK')->plainTextToken;  // !!! Change it for security !!!
            $success['name'] =  $authUser->name;
            $success['uuid'] =  $authUser->uuid;
   
            return $this->sendResponse($success, 'Device signed in');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }   
}