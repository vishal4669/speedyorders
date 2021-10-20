<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use session;

class LoginController extends Controller {

	
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __construct(Request $request) {

	}

	public function index() {
        $activePage = 'login';        
		return view('login', compact('activePage'));
	}
	
	

}
