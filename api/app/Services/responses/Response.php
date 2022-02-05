<?php


namespace Services\responses;


class Response
{
    protected int $code;
    public function __construct(int $code) {
        $this->code = $code;
    }

    public function json(): void {
        header('Content-Type: application/json');
        http_response_code($this->code);
    }
}