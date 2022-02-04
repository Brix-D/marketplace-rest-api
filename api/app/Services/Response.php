<?php


namespace Services;


class Response
{
    public function __construct(int $code = 200, array $data = [], string $message = '') {
        header('Content-Type: application/json');
        http_response_code($code);
        $response = [];
        if ($code !== 200) {
            $response['status'] = $code;
        }
        if (!empty($message)) {
            $response['message'] = $message;
        }
        if (!empty($data)) {

            if ($code == 200) {
                $response = $data;
            } else {
                $response['data'] = $data;
            }

        }
        echo json_encode($response);
        exit();
    }
}