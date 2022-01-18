<?php


namespace Evrinoma\StrategyBundle\Constraint;


use Evrinoma\UtilsBundle\Constraint\ConstraintInterface;
use Symfony\Component\Validator\Constraints\NotNull;

class Name implements ConstraintInterface
{
//region SECTION: Getters/Setters
    public function getConstraints(): array
    {
        return [
            new NotNull(),
        ];
    }

    public function getPropertyName(): string{
        return 'name';
    }
//endregion Getters/Setters
}