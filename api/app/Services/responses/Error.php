<?php


namespace Services\responses;


class Error implements Response
{
    private function __construct()
    {
    }

    public static function json(int $code, \Exception $error = null, string $message = ''): void
    {
        header('Content-Type: application/json');
        http_response_code($code);
        $response = ['code' => $code];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        if (!is_null($error)) {
            $response['error'] = $error->getTrace();
        }
        echo json_encode($response);
    }
}