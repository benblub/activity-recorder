<?php


namespace App\Tests\Entity;


use App\Entity\Activity;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ActivityTest extends TestCase
{
    public function testSetUser()
    {
        $activity = new Activity();
        $activity->setUser(new User());

        $this->assertInstanceOf(User::class, $activity->getUser());
    }

}