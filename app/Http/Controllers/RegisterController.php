<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use session;

class RegisterController extends Controller {

	
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __construct(Request $request) {

	}

	public function index() {
        $activePage = 'register';        
		return view('signup', compact('activePage'));
	}
	
	

}
