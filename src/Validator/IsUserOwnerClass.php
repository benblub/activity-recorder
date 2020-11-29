<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsUserOwnerClass extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'You can only set your own User Object!';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
