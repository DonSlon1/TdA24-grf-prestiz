<?php


namespace App\Controllers;

use Core\Controller;
use \App\Views\View;
use Core\Http\Request;

class Activities extends Controller
{
    public function allActivities(Request $request): void
    {
        View::createWithViewFile('Activities/AllActivities.php')->render();
    }

    public function notFound(): void
    {
        View::createWithViewFile('home/404.php')->render();
    }
}