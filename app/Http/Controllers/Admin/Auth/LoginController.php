<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdministratorSignInRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:administrator-web')->except('signOut');
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
    public function signIn(AdministratorSignInRequest $request)
    {
        if (Auth::guard('administrator-web')->attempt([$this->username() => $request->npk, 'password' => $request->password])) {
            return redirect(route('administrator.dashboard'));
        }

        return $this->sendFailedSignInResponse();
    }

    public function signInForm()
    {
        return view('administrators.authentication.sign-in');
    }

    public function signOut()
    {
        Auth::guard('administrator-web')->logout();
        return redirect(route('administrator.sign-in-form'));
    }

    public function sendFailedSignInResponse()
    {
        throw ValidationException::withMessages([
            'npk' => [trans('auth.failed')]
        ]);
    }
}
