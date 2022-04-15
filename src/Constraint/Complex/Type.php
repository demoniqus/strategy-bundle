<?php


namespace Demoniqus\StrategyBundle\Constraint\Complex;


use Demoniqus\StrategyBundle\Constraints\TypeStrategy;
use Evrinoma\UtilsBundle\Constraint\Complex\ConstraintInterface;

class Type implements ConstraintInterface
{
//region SECTION: Getters/Setters
    public function getConstraints(): array
    {
        return [
            //NotNull and NotBlack constraints cannot be applied as part of complex constraint
            new TypeStrategy(),
        ];
    }

    public function getPropertyName(): string
    {
        return 'type';
    }
//endregion Getters/Setters
}