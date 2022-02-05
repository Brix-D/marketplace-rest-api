<?php


namespace Services\responses;


class Success extends Response
{
    private mixed $data;
    public function __construct(int $code = 200, mixed $data = [])
    {
        if ($code < 200 || $code >= 300) {
            exit();
        }
        parent::__construct($code);
        $this->data = $data;
    }

    public function json(): void
    {
        parent::json();
        echo json_encode($this->data);
    }
}