<?php


namespace Services\responses;


class Error extends Response
{
    private string $message;
    private \Exception|null $error;
    public function __construct(int $code, \Exception $error = null, string $message = '')
    {
        parent::__construct($code);
        $this->message = $message;
        $this->error = $error;
    }

    public function json(): void
    {
        parent::json();
        $response = ['code' => $this->code];
        if (!empty($this->message)) {
            $response['message'] = $this->message;
        }
        if (!is_null($this->error)) {
            $response['error'] = $this->error->getTrace();
        }
        echo json_encode($response);
    }
}