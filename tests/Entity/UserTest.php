<?php


namespace App\Tests\Entity;


use App\Entity\Activity;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testAddActivity()
    {
        $user = new User();
        $user->addActivity(new Activity());
        $user->addActivity(new Activity());

        $this->assertCount(2, $user->getActivities());
    }

    public function testRemoveActivity()
    {
        $activity = new Activity();

        $user = new User();
        $user->addActivity($activity);
        $user->removeActivity($activity);

        $this->assertCount(0, $user->getActivities());
    }
}