<?php
namespace App\Factory;

use App\Entity\User;

class UserFactory
{
    public function createUser() : User
    {
        $user = new User();
        $user->setEmail('mail@mail.com');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_USER']);

        return $user;
    }
}