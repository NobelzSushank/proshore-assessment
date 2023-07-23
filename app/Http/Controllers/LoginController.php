<?php

namespace App\Http\Controllers;

use App\Enums\RoleTypeEnum;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class LoginController extends Controller
{
    public function show()
    {
        $this->setPageTitle('Login', '');
        return view('auth.login');
    }

    /**
     * Login with the email and password
     *
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $credentials = ['email' => $request->email, 'password' => $request->password];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                if (Auth::user()->role->slug === RoleTypeEnum::ADMIN->value)
                {
                    return redirect()->route('user.index');
                }
                return redirect()->route('questionnaire.list');
            }

            return $this->responseRedirect(
                route: 'login',
                message: 'Invalid Credentials.',
                type: 'error',
                error: true,
                withOldInputWhenError: true
            );

        } catch (Throwable $e) {
            return redirect()->back()->with(['error' => __('your_account_is_not_activated')]);
        }

    }
}
