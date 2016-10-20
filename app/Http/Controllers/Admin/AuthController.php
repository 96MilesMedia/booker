<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;;
use App\Models\User;
use Sentinel;
use Illuminate\Support\Facades\App;
use App\Services\Transformers\UserTransformer;

class AuthController extends Controller
{
    public function __construct(Request $request, UserTransformer $transformer)
    {
        $this->request = $request;
        $this->setTransformer($transformer);
    }

    public function authenticate()
    {
        $request = $this->request->all();

        $user = Sentinel::authenticate($request);

        if (!$user) {
            // $throttle = App::make('sentinel.throttling');

            return $this->respondWithError(403, "Login Failed");
        }

        return $this->respond($this->transformItem($user));
    }

    public function logout()
    {
        if (Sentinel::logout(Sentinel::getUser(), true)) {
            return $this->respond("Logout successfully");
        }
        return $this->respondInternalError("Could not log out");
    }

    public function updateSettings()
    {
        $credentials = $this->request->all();

        $user = Sentinel::findById(Sentinel::getUser()->id);

        // For when confirming old password comes in
        // $validate = $this->validateCurrentPassword($credentials['currentPassword'], $user);
        $validate = true;

        if (!$validate) {
            return $this->respondBadRequest("Invalid Password");
        }

        $res = Sentinel::update($user, [
                'email'    => $credentials['email'],
                'password' => $credentials['password']
            ]);

        return $this->respondUpdated("Password updated");
    }

    public function register()
    {
        $credentials = $this->request->all();

        Sentinel::register(array(
            'email'    => $credentials['email'],
            'password' => $credentials['password'],
        ));

        return $this->respondCreated();
    }

    public function validateCurrentPassword($password, User $user)
    {
        $checkCredentials = [
            'password' => $password
        ];

        $checkPasswords = Sentinel::validateCredentials($user, $checkCredentials);

        if ((bool) $checkPasswords == false) {
            return false;
        }

        return true;
    }
}
