<?php

namespace Core;

use Core\Http\{
    Request,
    Response
};
use DateTime;
use DateTimeZone;
use Exception;

abstract class Controller
{
    public function get(Request $request): void
    {
        throw new \Exception('Not implemented');
    }

    public function post(Request $request): void
    {
        throw new \Exception('Not implemented');
    }

    public function update(Request $request): void
    {
        throw new \Exception('Not implemented');
    }

    public function index(Request $request): void
    {
        throw new \Exception('Not implemented');
    }

    protected function requireParams(array $params, Request $request): void
    {
        foreach ($params as $param) {
            if (isset($request->getBody()->$param)) {
                unset($params[array_search($param, $params)]);
            }
        }
        if (!empty($params)) {
            $this->returnMessage(400, 'Missing required parameters: ' . implode(', ', $params));
            exit;
        }
    }

    protected function returnMessage(int $code, string $message): void
    {
        Response::writeJsonBody([
            'code' => $code,
            'message' => $message
        ])
            ->setStatusCode($code)
            ->send();
    }

    protected function parseDateTime(string $date, string $timeZone = 'UTC'): string|false
    {
        try {
            return (
            new DateTime($date, new DateTimeZone($timeZone))
            )
                ->format('Y-m-d H:i:s');
        } catch (Exception) {
            return false;
        }
    }

    protected function formatDateTime(string $date): string
    {
        try {
            return (
            new DateTime($date, new DateTimeZone('UTC'))
            )->format(DATE_ATOM);
        } catch (Exception) {
            return $date;
        }

    }
}