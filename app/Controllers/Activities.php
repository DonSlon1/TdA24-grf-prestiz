<?php

namespace App\Controllers;

use App\Models\Activity as ActivityModel;
use Core\Controller;
use App\Views\View;
use Core\Http\Request;

class Activities extends Controller
{
    public function __construct(
        private readonly ActivityModel $activityModel
    ) {
    }

    public function allActivities(Request $request): void
    {
        $activities = $this->activityModel->getAll();
        View::createWithViewFile('Activities/AllActivities.php')->render(['activities' => $activities]);
    }

    public function singleActivity(Request $request): void
    {
        $uuid = $request->getUrlParams()->uuid ?? null;
        if ($uuid === null) {
            $this->notFound();
            return;
        }

        $activity = $this->activityModel->getById($uuid)[0] ?? null;
        if ($activity === null) {
            $this->notFound();
            return;
        }

        View::createWithViewFile('Activities/ActivityPage.php')->render(['activity' =>$activity]);
    }

    public function notFound(): void
    {
        View::createWithViewFile('home/404.php')->render();
    }
}