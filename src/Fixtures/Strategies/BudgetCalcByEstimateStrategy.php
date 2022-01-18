<?php

namespace Evrinoma\StrategyBundle\Fixtures\Strategies;


use Evrinoma\StrategyBundle\Fixtures\Model\TypeModelInterface;
use Evrinoma\StrategyBundle\Interfaces\StrategyInterface;

final class BudgetCalcByEstimateStrategy implements StrategyInterface
{
//region SECTION: Public
    public function execute(): void
    {
        //calculate budget by estimates
    }
//endregion Public

//region SECTION: Getters/Setters
    public static function getType(): string
    {
        return TypeModelInterface::TYPE_BUDGET_CALC_STRATEGY;
    }
//endregion Getters/Setters
}