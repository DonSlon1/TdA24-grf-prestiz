<?php

namespace App\Controllers;

use Core\Controller;
use App\Views\View;
use Core\Http\Request;
use Core\Util\Auth;

class Login extends Controller
{

    public function __construct(
    )
    {
    }
    public function logout(Request $request): void
    {
        Auth::logout();
    }

    public function login(Request $request): void
    {
        if (Auth::isLoggedIn()) {
            header('Location: /admin');
            return;
        }
        View::createWithViewFile('login/login.php')->render();
    }

    public function interface(Request $request): void
    {
        View::createWithViewFile('login/admin-interface.php')->render();
    }
}