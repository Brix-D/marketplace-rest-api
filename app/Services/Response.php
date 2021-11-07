<?php


namespace Services;


class Response
{
    public function __construct(int $code, array $data = [], string $message = '') {
        header('Content-Type: application/json');
        http_response_code($code);
        $response = ['status' => $code];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        if (!empty($data)) {
            $response['data'] = $data;
        }
        echo json_encode($response);
        exit();
    }
}