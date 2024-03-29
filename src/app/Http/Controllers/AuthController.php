<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Constructor
    public function __construct(public AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        // Check captcha if failed attempt >= 3
        $maxFailureAccepted = env('FAILED_LOG_IN_ATTEMPT', 3);
        $failedLoginAttempt = Session::get('failedLoginAttempt');
        if ($failedLoginAttempt >= $maxFailureAccepted) {
            // Validate captcha
            $isValidCaptcha = !Validator::make([
                'captcha' => $request->get('captcha'),
            ], ['captcha' => ['required', 'captcha',],
            ])->fails();
        }

        if (!isset($isValidCaptcha) || $isValidCaptcha === true) {
            $email = $request->get('email');
            $password = $request->get('password');

            if ($this->authService->login($email, $password)) {
                Session::put('failedLoginAttempt', 0);
                return redirect()->intended('/home');
            }
        }
        $newValueOfAttempt = empty($failedLoginAttempt) ? 1 : ++$failedLoginAttempt;
        Session::put('failedLoginAttempt', $newValueOfAttempt);
        $isCaptchaRequired = $failedLoginAttempt >= $maxFailureAccepted;
        $errorMessage = (isset($isValidCaptcha) && $isValidCaptcha === false) ? 'Incorrect captcha' : 'Invalid login';

        return view('login', [
            'errorMessage' => $errorMessage,
            'isCaptchaRequired' => $isCaptchaRequired,
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return view('register', [
                'errors' => $errors->messages(),
            ]);
        }

        // Create user
        $email = $request->get('email');
        $password = $request->get('password');

        $newUser = new User();
        $newUser->email = $email;
        $newUser->password = Hash::make($password);

        $newUser->save();

        return view('home', [
            'message' => 'User created: ' . $newUser->id . ': ' . $newUser->email,
        ]);
    }

    public function logout()
    {
        $this->authService->logout();

        return redirect('/home');
    }

}
