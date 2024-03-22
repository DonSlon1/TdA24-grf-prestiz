<?php

namespace App\Controllers;

use App\Api\Client;
use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;

class Prompt extends Controller
{
    private const MAX_COUNT = 3;

    public function __construct(
        private readonly Client $client
    ) {
    }

    public function process(Request $request) : void
    {
        $body = $request->getBody();

        $prompt = $body->prompt ?? null;
        $count = $body->count ?? null;

        if (empty($prompt)) {
            $this->returnMessage(400,'Prompt is not set.');
            return;
        }

        if (!is_string($prompt)) {
            $this->returnMessage(400,'Prompt is not a string.');
            return;
        }

        if (is_null($count)) {
            $count = 1;
        }

        if (!is_int($count)) {
            $this->returnMessage(400,'Count is not an integer.');
            return;
        }

        if ($count < 1) {
            $this->returnMessage(400,'Count is less than 1.');
            return;
        }

        if ($count > self::MAX_COUNT) {
            $this->returnMessage(400,'Count is greater than ' . self::MAX_COUNT);
            return;
        }

        $prompt = $body->prompt;
        $count = $body->count;

        $replies = $this->client->sendPrompt([
            ['role' => 'user', 'content' => $prompt],
        ], $count);

        Response::writeJsonBody([
            "replies" => $replies
        ])->send();
    }
}
