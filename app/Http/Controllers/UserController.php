<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
    	return view('pages/login');
    }

    public function checklogin(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'email' 	=> 'required|email',
            'password' 	=> 'required',
        ]);
       
       	$data = $request->only('email', 'password');
	    
	    if(!$validator->fails())
    	{
	        if(Auth::attempt($data))
	        {
	        	$response = [
	                'success' => true,
	                'message' => 'Login Success'
            	];
	         	return response()->json($response, 200);
	        }else{
	        	$response = [
	                'success' => false,
	                'message' => 'Check yoour Email or Password'
            	];
	      		return response()->json($response, 302);
	        }
	    }else{
	    	$response = [
                'success' => false,
                'errors'  => $validator->errors(),
                'message' => 'Validation Error'
            ];
	      return response()->json($response, 400);
     	}
    }

    public function logout()
    {
     	Auth::logout();
     	return redirect('/login');
    }

}
