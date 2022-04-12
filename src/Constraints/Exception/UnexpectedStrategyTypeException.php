<?php


namespace Demoniqus\StrategyBundle\Constraints\Exception;


use Symfony\Component\Validator\Exception\ValidatorException;

final class UnexpectedStrategyTypeException extends ValidatorException
{
//region SECTION: Constructor
    public function __construct($value, string $expectedType)
    {
        parent::__construct(sprintf('Expected argument of type "%s", "%s" given', $expectedType, get_debug_type($value)));
    }
//endregion Constructor

}