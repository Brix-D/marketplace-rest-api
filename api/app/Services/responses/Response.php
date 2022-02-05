<?php


namespace Services\responses;


interface Response
{
    public static function json(int $code): void;
}