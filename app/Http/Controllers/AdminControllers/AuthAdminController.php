<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Requests\LoginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Exception;

use App\Models\Admin;

class AuthAdminController extends WebAppBaseController
{
    //
    public function login()
    {
        return view('admin.auth.login', ['title' => 'Login']);
    }

    public function loginValidate(LoginRequest $request)
    {
        try {
            $credentials = $request->getCredentials('username', 'password');
            $email = isset($credentials['email']) ? $credentials['email'] : '';
            $username = isset($credentials['username']) ? $credentials['username'] : '';
            $password = $credentials['password'];

            if (
                Auth::attempt(['username' => $username, 'password' => $password])
                || Auth::attempt(['email' => $email, 'password' => $password])
            ) {
                $admin = (new Admin())->get_by_auth($credentials);

                if (isset($admin) && isset($admin->admin_id)) {
                    $user = Auth::getProvider()->retrieveById($admin->admin_id);
                    // Auth::login($user);
                    $last_login = isset($user->last_login) ? $user->last_login : date('Y-m-d');
                    request()->session()->put('admin_id', $user->admin_id);
                    request()->session()->put('first_name', $user->first_name);
                    request()->session()->put('last_name', $user->last_name);
                    request()->session()->put('username', $user->username);
                    request()->session()->put('email', $user->email);
                    request()->session()->put('image', $user->image);
                    request()->session()->put('gender', $user->gender);
                    request()->session()->put('last_login', $last_login);

                    $adminModel = new Admin();
                    $adminModel->updateLastLogin($user);

                    return $this->sendResponse('', 'Login successful.', "/dashboard");
                } else {
                    return $this->sendError("Sorry! Incorrect login details.",[], 401);
                }
            } else {
                return $this->sendError("Sorry! Incorrect login details.", [], 401);
            }
        } catch (Exception $ex) {
            return $this->sendError($ex->getMessage(), [], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect(env('ADMIN_URL_PREFIX') . '/login');
    }
}
