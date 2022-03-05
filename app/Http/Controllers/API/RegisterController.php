<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;


class RegisterController extends Controller
{
    public function register(Request $request)
    
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
 
        if ($validator->fails()) {
            return (new BaseController)->sendError('Validation Error.', $validator->errors());       
        }
 
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
 
        return (new BaseController)->sendResponse($success, 'User registered successfully.');
    }

    public function login(Request $request)
    {
        
        if (auth()->attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = auth()->user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
 
            return (new BaseController)->sendResponse($success, 'User login successfully.');
        } else {
            return (new BaseController)->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

}
