<?php


namespace Demoniqus\StrategyBundle\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\CallbackValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class TypeStrategyValidator extends CallbackValidator
{
//region SECTION: Public
    public function validate($object, Constraint $constraint)
    {
        if (!$constraint instanceof TypeStrategy) {
            throw new UnexpectedTypeException($constraint, TypeStrategy::class);
        }
        parent::validate($object, $constraint);
    }
//endregion Public
}