<?php

namespace Core\Http;

class Response
{
    private string $body;
    private int $statusCode = 200;
    private array $headers = [];

    public static function writeJsonBody(object|array $data): self
    {
        $response = new self();
        $response->setBody($data);
        $response->setHeaders('Content-Type', 'application/json');
        return $response;
    }

    public static function withEmptyBody(): self
    {
        return new self();
    }

    public function send(): void
    {
        if (headers_sent()) {
            return;
        }

        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        echo $this->body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(array|object|string $body): self
    {
        if (is_array($body) || is_object($body)) {
            $body = json_encode($body);
        }

        $this->body = $body;
        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }


}