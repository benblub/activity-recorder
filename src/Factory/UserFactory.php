<?php
namespace App\Factory;

use App\Entity\User;

class UserFactory
{
    public function createUser(string $email, bool $enabled, array $roles) : User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setEnabled($enabled);
        $user->setRoles($roles);

        return $user;
    }
}