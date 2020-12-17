<?php
namespace App\Factory;

use App\Entity\User;

class UserFactory
{
    /**
     * @param string $email
     * @param bool $enabled
     * @return User
     */
    public function createUser(string $email, bool $enabled) : User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setEnabled($enabled);
        $user->setRoles([User::ROLE_USER]);
        $user->setApiToken(uniqid());

        return $user;
    }

    /**
     * @param string $email
     * @param bool $enabled
     * @return User
     */
    public function createAdmin(string $email, bool $enabled) : User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setEnabled($enabled);
        $user->setRoles([User::ROLE_ADMIN]);
        $user->setApiToken(uniqid());

        return $user;
    }
}