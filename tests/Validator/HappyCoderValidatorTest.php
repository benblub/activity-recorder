<?php
namespace App\tests\Validator;

use App\Validator\HappyCoder;
use App\Validator\HappyCoderValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class HappyCoderValidatorTest extends TestCase
{
    public function testValidate() : void
    {
        $constraint = new HappyCoder();

        /** @var ExecutionContextInterface|MockObject $context */
        $context = $this->getMockExecutionContext();
        $context->expects($this->never())->method('buildViolation');

        $validator = new HappyCoderValidator();
        $validator->initialize($context);
        $validator->validate('awesome foo', $constraint);
    }

    private function getMockExecutionContext() : ExecutionContext
    {
        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $context;
    }
}