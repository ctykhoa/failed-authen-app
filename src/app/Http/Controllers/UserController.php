<?php

namespace App\Http\Controllers;

use App\Http\Services\ErrorService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct(UserService  $userService,
                                ErrorService $errorService)
    {
        $this->userService = $userService;
        $this->errorService = $errorService;
    }

    // profile
    public function viewProfile()
    {
        $userDetail = $this->userService->getUserProfile();
        if ($userDetail) {
            return view('users.profile', [
                'isEditable' => false,
                'user' => $userDetail,
            ]);
        }

        return $this->errorService->throwNotFoundError();
    }

    // edit profile
    public function editProfile(Request $request)
    {
        $userDetail = $this->userService->getUserProfile();

        // send form
        if ($request->method() === 'GET') {
            return view('users.profile', [
                'isEditable' => true,
                'user' => $userDetail,
            ]);
        }

        // handle update profile request
        $validator = Validator::make($request->input(), [
            'email' => 'email|'.Rule::unique('users', 'email')->ignore(Session::get('user_id')),
            'phone' => 'string|min:10|max:14|'.Rule::unique('users', 'phone')->ignore(Session::get('user_id')),
            'shipping_address' => 'string|max:500',
        ]);
        if ($validator->fails()) {
            return view('users.profile',[
                'errors' => $validator->errors()->messages(),
                'isEditable' => true,
                'user' => $userDetail,
            ]);
        }

        if($this->userService->updateUserProfile($request->input())) {
            // success
            $updated = $this->userService->getUserProfile();

            return view('users.profile',[
                'isEditable' => true,
                'user' => $updated,
            ]);
        }

        return response()->view('errors.server_error', [], 500);
    }
}
