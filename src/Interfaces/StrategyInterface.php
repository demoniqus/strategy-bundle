<?php


namespace Evrinoma\StrategyBundle\Interfaces;

/**
 * Strategy as concrete realization (AbstractStrategy::name)
 */
interface StrategyInterface
{
//region SECTION:Public

//endregion Public
//region SECTION: Getters/Setters
    public static function getType(): string;

    public function execute(): void;
//endregion Getters/Setters
}