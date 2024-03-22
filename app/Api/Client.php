<?php

namespace App\Api;

use Core\Controller;
use Orhanerday\OpenAi\OpenAi;

class Client extends Controller
{
    private readonly OpenAi $openAi;

    public function __construct(
        private readonly Integration $integration,
    ) {
        $this->openAi = new OpenAi($this->integration->getToken());
    }

    public function sendPrompt(array $messages, int $count = 1)
    {
        $response = $this->openAi->chat(
            [
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages,
                'n' => $count,
            ]
        );

        $decoded = json_decode($response);

        $replies = [];

        foreach ($decoded->choices as $choice) {
            $replies[] = $choice->message->content;
        }

        return $replies;
    }
}
