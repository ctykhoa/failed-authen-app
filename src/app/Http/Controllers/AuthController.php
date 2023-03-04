<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $email = $request->get('email');
        $password = $request->get('password');

        if ($this->authService->login($email, $password)) {
            return redirect()->intended('/home');
        }

        return view('login', [
            'errorMessage' => 'Invalid login',
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
                'errors' => $errors,
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

    public function logout() {
        $this->authService->logout();

        return redirect('/home');
    }

}
