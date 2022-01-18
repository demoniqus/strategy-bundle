<?php

namespace Evrinoma\Example;

use Evrinoma\StrategyBundle\Interfaces\StrategyInterface;
use Evrinoma\StrategyBundle\Model\Strategy\AbstractStrategy;

final class SumCalculationStrategy implements StrategyInterface
{
//region SECTION: Fields

//endregion Fields

//region SECTION: Constructor

//endregion Constructor

//region SECTION: Protected

//endregion Protected

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