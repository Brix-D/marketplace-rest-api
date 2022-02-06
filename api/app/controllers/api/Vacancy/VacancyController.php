<?php

namespace Controllers\Api\Vacancy;
use Models\Vacancy;
use Services\responses\Success;
use Services\responses\Error;

class VacancyController
{
    public static function show():void
    {
        $vacancy = Vacancy::all()->toArray();
        Success::json(data: $vacancy);
    }
}