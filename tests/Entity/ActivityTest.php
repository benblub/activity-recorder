<?php


namespace App\Tests\Entity;


use App\Entity\Activity;
use App\Entity\User;
use App\Exception\NotHappyException;
use PHPUnit\Framework\TestCase;

class ActivityTest extends TestCase
{
    public function testSetUser()
    {
        $activity = new Activity();
        $activity->setUser(new User());

        $this->assertInstanceOf(User::class, $activity->getUser());
    }

    public function testYouNeedToBeHappy()
    {
        $activity = new Activity();

        $this->expectException(NotHappyException::class);

        $activity->setDescription('unhappy');
    }
}