<?php


namespace Evrinoma\StrategyBundle\Constraints\Exception;


use Symfony\Component\Validator\Exception\ValidatorException;

class UnexpectedStrategyTypeException extends ValidatorException
{
//region SECTION: Fields

//endregion Fields

//region SECTION: Constructor
    public function __construct($value, string $expectedType)
    {
        parent::__construct(sprintf('Expected argument of type "%s", "%s" given', $expectedType, get_debug_type($value)));
    }
//endregion Constructor

//region SECTION: Protected

//endregion Protected

//region SECTION: Public

//endregion Public

//region SECTION: Getters/Setters

//endregion Getters/Setters
}