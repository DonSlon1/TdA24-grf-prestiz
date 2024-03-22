<?php

namespace App\Controllers;

use Core\Controller;
use \App\Views\View;
use Core\Http\Request;

class Home extends Controller
{
    public function index(Request $request): void
    {
        View::createWithViewFile('home/home.php')->render();
    }

    public function notFound(): void
    {
        View::createWithViewFile('home/404.php')->render();
    }
}