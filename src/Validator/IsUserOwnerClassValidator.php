<?php

namespace App\Validator;

use App\Entity\Activity;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsUserOwnerClassValidator extends ConstraintValidator
{
    /**
     * @var Security
     */
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function validate($activity, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\IsUserOwnerClass */
        /** @var $activity Activity */

        if (null === $activity || '' === $activity) {
            return;
        }

        if ($activity->getUser() !== $this->security->getUser()) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
