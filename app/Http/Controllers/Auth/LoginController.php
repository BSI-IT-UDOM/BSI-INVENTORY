<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'sys_name';
    }

    protected function credentials(Request $request)
    {
        return array_merge(
            $request->only($this->username(), 'password'),
            ['status' => 'Active']
        );
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where($this->username(), $request->{$this->username()})->first();
        if ($user && $user->status === 'Inactive') {
            throw ValidationException::withMessages([
                $this->username() => ['Your account is inactive. Please contact support.'],
            ]);
        }
        return Auth::attempt($this->credentials($request));
    }
}
