<?php

namespace App\Test;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use App\Entity\Activity;
use DateTime;

class CustomApiTestCase extends ApiTestCase
{
    const RESOURSE_RESPONSE_200 = 200;
    const RESOURSE_CREATED_201 = 201;
    const RESOURCE_DELETED_204 = 204;
    const INVALID_INPUT_400 = 400;
    const FORBIDDEN_403 = 403;
    const RESOURCE_NOT_FOUND_404 = 404;
    const UNAUTHORIZED_401 = 401;

    protected function createActivity() : Activity
    {
        $activity = new Activity();
        $activity->setActivityDate(new DateTime());
        $activity->setPerformendTime(1.0);
        $activity->setText("awesome code written!");

        return $activity;
    }
}