<?php


namespace Services\responses;


class Success implements Response
{
    private function __construct()
    {

    }

    public static function json(int $code = 200, mixed $data = []): void
    {
        if ($code < 200 || $code >= 300) {
            exit();
        }
        header('Content-Type: application/json');
        http_response_code($code);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}