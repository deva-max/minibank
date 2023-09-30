<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login' => 'required|string', // Rename the input field to 'login'
            'password' => 'required|string',
        ], [
            'login.required' => 'The email or phone number field is required.',
            'password.required' => 'The password field is required.', // Add this line
        ]);
    }


    public function attemptLogin(Request $request)
    {
        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        $request->merge([$field => $request->input('login')]);

        $credentials = $request->only($field, 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            return true;
        }

        return redirect()->route('login')
            ->withInput($request->only('login', 'remember'))
            ->withErrors(['login' => 'Invalid credentials. Please check your email/phone and password.']);
    }

}
