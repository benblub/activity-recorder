<?php
namespace App\Factory;

use App\Entity\User;

class UserFactory
{
    public function createUser(string $email, bool $enabled) : User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setEnabled($enabled);
        $user->setRoles(['ROLE_USER']);

        return $user;
    }

    public function createAdmin(string $email, bool $enabled) : User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setEnabled($enabled);
        $user->setRoles(['ROLE_ADMIN']);

        return $user;
    }
}