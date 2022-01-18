<?php


namespace Evrinoma\StrategyBundle\Constraints;



use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\CallbackValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TypeStrategyValidator extends CallbackValidator
{
//region SECTION: Fields

//endregion Fields

//region SECTION: Constructor

//endregion Constructor

//region SECTION: Protected

//endregion Protected

//region SECTION: Public
    public function validate($object, Constraint $constraint)
    {
        if (!$constraint instanceof TypeStrategy) {
            throw new UnexpectedTypeException($constraint, TypeStrategy::class);
        }
        parent::validate($object, $constraint);
    }
//endregion Public

//region SECTION: Getters/Setters

//endregion Getters/Setters
}