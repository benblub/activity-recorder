<?php

namespace App\Test;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use App\Entity\Activity;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class CustomApiTestCase extends ApiTestCase
{
    const RESOURSE_RESPONSE_200 = 200;
    const RESOURSE_CREATED_201 = 201;
    const RESOURCE_DELETED_204 = 204;
    const INVALID_INPUT_400 = 400;
    const FORBIDDEN_403 = 403;
    const RESOURCE_NOT_FOUND_404 = 404;
    const UNAUTHORIZED_401 = 401;

    protected function getEntityManager(): EntityManagerInterface
    {
        return self::$container->get('doctrine')->getManager();
    }

    protected function createActivity() : Activity
    {
        $activity = new Activity();
        $activity->setActivityDate(new DateTime());
        $activity->setPerformendTime(1.0);
        $activity->setDescription("awesome code written!");

        $em = $this->getEntityManager();
        $em->persist($activity);
        $em->flush();

        return $activity;
    }
}