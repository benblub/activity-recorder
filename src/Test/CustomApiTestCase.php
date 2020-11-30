<?php

namespace App\Test;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Activity;
use App\Entity\User;
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

    protected function getPasswordEncoder()
    {
        return self::$container->get('security.user_password_encoder.generic');
    }

    protected function createActivity() : Activity
    {
        $user = $this->createUser();

        $activity = new Activity();
        $activity->setActivityDate(new DateTime());
        $activity->setPerformendTime(1.0);
        $activity->setDescription("awesome code written!");
        $activity->setUser($user);

        $this->save($activity);

        return $activity;
    }

    protected function createUser() : User
    {
        $passwordEncoder = $this->getPasswordEncoder();

        $user = new User();
        $user->setEmail(uniqid() . '@mail.com');
        $user->setPassword(
            $passwordEncoder->encodePassword($user, 'superSecret')
        );
        $user->setRoles(['ROLE_USER']);
        $user->setApiToken(uniqid());
        $user->setEnabled(true);

        $this->save($user);

        return $user;
    }

    protected function login(string $email, string $password)
    {
        $client = self::createClient();
        $client->request('POST', '/login', [
           'json' => [
               'email' => $email,
               'password' => $password
           ]
        ]);

        $this->assertResponseStatusCodeSame(204);
    }

    protected function logout()
    {
        // todo : logout
    }

    private function save($entity)
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }
}