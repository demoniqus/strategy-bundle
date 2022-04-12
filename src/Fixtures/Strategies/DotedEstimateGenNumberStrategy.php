<?php

namespace Demoniqus\StrategyBundle\Fixtures\Strategies;


use Demoniqus\StrategyBundle\Fixtures\Model\TypeModelInterface;
use Demoniqus\StrategyBundle\Interfaces\StrategyInterface;

final class DotedEstimateGenNumberStrategy implements StrategyInterface
{
//region SECTION: Public
    public function execute(): void
    {
        //generate estimate number use dot
    }
//endregion Public

//region SECTION: Getters/Setters
    public static function getType(): string
    {
        return TypeModelInterface::TYPE_ESTIMATE_GEN_NUMBER_STRATEGY;
    }
//endregion Getters/Setters
}