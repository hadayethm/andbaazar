<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Sentinel;
class AuthController extends Controller{

	public function adminlogin(){
		if (!Sentinel::check())
			return view('auth.admin.login');
		else
			return redirect('andbaazaradmin/dashboard');
	}

	public function adminloginprocess(Request $request){
		// dd($request->all());
		$credentials = [
			'email'		=> $request->login['email'],
			'password'	=> $request->login['password'],
			'type'		=> 'admin'
		];

		if($request->remember == 'on')
			$user = Sentinel::authenticateAndRemember($credentials);
		else
			$user = Sentinel::authenticate($credentials);

		if($user)
			return redirect('andbaazaradmin/dashboard');
		else
			return redirect('andbaazaradmin/login')->with('error', 'Invalid email or password');
	}

	public function logout(){
		Sentinel::logout(null, true);
		return redirect('/');
	}
}