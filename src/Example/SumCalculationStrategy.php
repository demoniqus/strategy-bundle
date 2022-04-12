<?php

namespace Demoniqus\StrategyBundle\Example;

use Demoniqus\StrategyBundle\Interfaces\StrategyInterface;

final class SumCalculationStrategy implements StrategyInterface
{
//region SECTION: Public
    public function execute(): void
    {
        /**
         * Основной код стратегии
         */
    }
//endregion Public

//region SECTION: Getters/Setters
    public static function getType(): string
    {
        return 'sumCalculationStrategy';
    }
//endregion Getters/Setters
}