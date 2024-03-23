<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use App\Models\Activity as ActivityModel;
use Core\Http\Response;
use JetBrains\PhpStorm\NoReturn;

class Activity extends Controller
{
    public function __construct(
       private readonly ActivityModel $activityModel
    )
    {
    }
    public function post(Request $request): void
    {
        $data = $request->getBody();

        // Validate required fields
        $requiredFields = [
            'uuid',
            'activityName',
            'objectives',
            'classStructure',
            'lengthMin',
            'lengthMax',
        ];
        $missingFields = array_diff($requiredFields, array_keys((array)$data));
        if (!empty($missingFields)) {
            $this->returnMessage(400, 'Missing required fields: ' . implode(', ', $missingFields));
            return;
        }
        if ($this->activityModel->getById($data->uuid,false)) {
            $this->returnMessage(409, 'Activity with this uuid already exists');
            return;
        }
        $activity =$this->activityModel->create($request->getBody());
        $activity = $this->activityModel->getById($activity->getUuid(),false)[0];

        Response::writeJsonBody($activity)->setStatusCode(200)->send();
    }
    public function delete(Request $request): void
    {
        if (!isset($request->getUrlParams()->uuid)) {
            $this->returnMessage(400, 'Missing activity uuid');
            return;
        }
        $uuid = $request->getUrlParams()->uuid;
        $activity = $this->activityModel->getById($uuid,false)[0]??null;
        if ($activity === null) {
            $this->returnMessage(404, 'Activity not found');
            return;
        }
        $this->activityModel->delete($uuid);
        $this->returnMessage(200, 'Activity deleted');
    }
    public function getAll() : void
    {
        $activities = $this->activityModel->getAll(false);
        Response::writeJsonBody($activities)->setStatusCode(200)->send();
    }
    public function get(Request $request) : void
    {
        if (!isset($request->getUrlParams()->uuid)) {
            $this->returnMessage(400, 'Missing activity uuid');
            return;
        }
        $activity = $this->activityModel->getById($request->getUrlParams()->uuid,false)[0]??null;
        if ($activity === null) {
            $this->returnMessage(404, 'Activity not found');
            return;
        }
        Response::writeJsonBody($activity)->setStatusCode(200)->send();
    }
        public function approveActivity(Request $request): void
{
    $uuid = $request->getUrlParams()->uuid ?? null;

    if (!$uuid) {
        $this->returnError('UUID aktivity je povinné.');
        return;
    }

    $result = $this->activityModel->approveActivity($uuid);

    if ($result === true) {
        $this->returnSuccess('Aktivita byla úspěšně schválena.');
    } else {
        $this->returnError('Aktivitu se nepodařilo schválit.');
    }
}
private function returnSuccess(string $message): void
{
    Response::writeJsonBody(['message' => $message])->send();
    exit;
}
    #[NoReturn] private function returnError(string $message): void
    {
        Response::writeJsonBody(['error' => $message], 400)->send();
        exit;
    }
}