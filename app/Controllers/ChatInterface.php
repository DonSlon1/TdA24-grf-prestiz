<?php

namespace App\Controllers;

use Core\Controller;
use \App\Views\View;
use Core\Http\Request;

class ChatInterface extends Controller
{
    public function chat(Request $request): void
    {
        View::createWithViewFile('ChatInterface/chat.php')->render();
    }

    public function notFound(): void
    {
        View::createWithViewFile('home/404.php')->render();
    }
}