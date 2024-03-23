<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;

use App\Models\Lektor;
use Core\Util\Auth as AuthUtil;
use JetBrains\PhpStorm\NoReturn;

class Auth extends Controller
{

    #[NoReturn]
    public function logout(Request $request): void
    {
        AuthUtil::logout();
    }

    public function login(Request $request): void
    {
        header('Content-Type: application/json');
        if (AuthUtil::authenticateBasic()){
            $this->returnMessage(200, 'Login successful');
        }
        else {
            $this->returnMessage(401, 'Invalid credentials');
        }

    }
}