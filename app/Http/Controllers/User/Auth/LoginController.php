<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserSignInRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:users-web')->except('signOut');
    }

    public function username()
    {
        return 'npk';
    }

    public function signIn(UserSignInRequest $request)
    {
        if (Auth::guard('users-web')->attempt([$this->username() => $request->npk, 'password' => $request->password])) {
            return redirect(route('users.dashboard'));
        }

        return $this->sendFailedSignInResponse();
    }

    public function signInForm()
    {
        return view('users.authentication.sign-in');
    }

    public function signOut()
    {
        Auth::guard('users-web')->logout();
        return redirect(route('users.sign-in-form'));
    }

    public function sendFailedSignInResponse()
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')]
        ]);
    }
}
