<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('signOut');
    }
    
    public function username()
    {
        return 'npk';
    }

    /**
     * Handling administrator sign in.
     * 
     * @return \Illuminate\Http\Response
     */
    public function signIn(Request $request)
    {
        //
    }

    public function signInForm()
    {
        return view('administrators.authentication.sign-in');
    }
}
