<?php


namespace Demoniqus\StrategyBundle\Constraint;


use Demoniqus\StrategyBundle\Constraints\TypeStrategy;
use Evrinoma\UtilsBundle\Constraint\ConstraintInterface;
use Symfony\Component\Validator\Constraints\NotNull;

class Type implements ConstraintInterface
{
//region SECTION: Getters/Setters
    public function getConstraints(): array
    {
        return [
            new NotNull(),
            new TypeStrategy(),
        ];
    }

    public function getPropertyName(): string
    {
        return 'type';
    }
//endregion Getters/Setters
}