<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;

use App\Models\Lektor;
use Core\Util\Auth as AuthUtil;

class Auth extends Controller
{

    public function __construct(
        private readonly Lektor $lektorModel
    )
    {
    }

    public function logout(Request $request): void
    {
        AuthUtil::logout();
    }

    public function login(Request $request): void
    {
        header('Content-Type: application/json');
        $data = $request->getBody();
        $requiredFields = ['password', 'username'];
        $this->requireParams($requiredFields, $request);

        $password = $this->lektorModel->getPassword($data->username);
        if ($password === false) {
            $this->returnMessage(401, 'Credentials not found');
            return;
        }
        if (AuthUtil::verifyPassword($data->password, $password)) {
            $lektor = $this->lektorModel->findLectorByUsername($data->username);
            setcookie('uuid', $lektor['uuid'], 0, '/', '');
            AuthUtil::login($data->username);
            $this->returnMessage(200, 'Login successful');
        } else {
            $this->returnMessage(401, 'Invalid credentials');
        }

    }
}