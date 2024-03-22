<?php

namespace App\Api;

class Integration
{
    public const NAME = 'OpenAi';

    private readonly string $token;

    public function __construct(
    ) {

        //$this->token = getenv('OPEN_API_KEY') ? getenv('OPEN_API_KEY'):'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';
        $this->token = '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';
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
