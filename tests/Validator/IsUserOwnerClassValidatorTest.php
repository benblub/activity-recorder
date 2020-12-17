<?php
namespace App\tests\Validator;

use App\Entity\Activity;
use App\Factory\UserFactory;
use App\Validator\IsUserOwnerClass;
use App\Validator\IsUserOwnerClassValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class IsUserOwnerClassValidatorTest extends KernelTestCase
{
    /**
     * @var UserFactory
     */
    private UserFactory $userFactory;

    /** @var Security|PHPUnit_Framework_MockObject_MockObject */
    private $security;

    public function setUp() : void
    {
        $this->userFactory = new UserFactory();

        $this->security = $this->getMockBuilder(Security::class)
            ->disableOriginalConstructor()
            ->getMock();

    }

    public function testValidate() : void
    {
        $user = $this->userFactory->createUser('mail@mail.ch', true);
        $activity = new Activity();
        $activity->setUser($user);


        $constraint = new IsUserOwnerClass();

        /** @var ExecutionContextInterface|MockObject $context */
        $context = $this->getMockExecutionContext();
        $context->expects($this->once())->method('buildViolation');

        $validator = new IsUserOwnerClassValidator($this->security);
        $validator->initialize($context);
        $validator->validate($activity, $constraint);
    }

    private function getMockExecutionContext() : ExecutionContext
    {
        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $context;
    }
}
