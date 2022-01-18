<?php

namespace Evrinoma\StrategyBundle\Fixtures\Strategies;


use Evrinoma\StrategyBundle\Fixtures\Model\TypeModelInterface;
use Evrinoma\StrategyBundle\Interfaces\StrategyInterface;

final class DashedEstimateGenNumberStrategy implements StrategyInterface
{
//region SECTION: Public
    public function execute(): void
    {
        //generate estimate number use dash
    }
//endregion Public

//region SECTION: Getters/Setters
    public static function getType(): string
    {
        return TypeModelInterface::TYPE_ESTIMATE_GEN_NUMBER_STRATEGY;
    }
//endregion Getters/Setters
}