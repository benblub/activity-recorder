<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HappyCoder extends Constraint
{
    public $message = 'Show happiness and use awesome in your Text!';
}
