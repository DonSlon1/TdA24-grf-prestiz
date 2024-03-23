<?php

namespace App\Controllers;

use App\Models\Activity as ActivityModel;
use Core\Controller;
use App\Views\View;
use Core\Http\Request;
use App\Api\Client;

class Activities extends Controller
{
    public function __construct(
        private readonly ActivityModel $activityModel,
        private readonly Client $client
    ) {
    }

    public function allActivities(Request $request): void
    {
        $activities = $this->activityModel->getAll();
        $query = $request->getQueryParams()->query ?? '';

        if (!empty($query)) {
            $activitiesJson = json_encode($activities);
            $replies = $this->client->sendPrompt([
                ['role' => 'user', 'content' => $query]
            ], 1, $activitiesJson);

            $filteredUuids = $replies[0] ?? [];
            $activities = array_filter($activities, function ($activity) use ($filteredUuids) {
                return in_array($activity['uuid'], $filteredUuids);
            });
        }

        View::createWithViewFile('Activities/AllActivities.php')->render(['activities' => $activities, 'query' => $query]);
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