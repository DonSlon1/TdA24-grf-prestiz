<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use App\Models\Activity as ActivityModel;
use Core\Http\Response;

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
        $activity =$this->activityModel->create($request->getBody());

        Response::writeJsonBody($activity)->setStatusCode(200)->send();
    }
}