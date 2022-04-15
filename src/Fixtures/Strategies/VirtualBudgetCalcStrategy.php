<?php


namespace Demoniqus\StrategyBundle\Fixtures\Strategies;


use Demoniqus\StrategyBundle\Fixtures\Model\TypeModelInterface;
use Demoniqus\StrategyBundle\Interfaces\StrategyInterface;

final class VirtualBudgetCalcStrategy implements StrategyInterface
{
//region SECTION: Public
    public function execute(): void
    {
        //some virtual strategy
    }
//endregion Public

//region SECTION: Getters/Setters
    public static function getType(): string
    {
        return TypeModelInterface::TYPE_BUDGET_CALC_STRATEGY;
    }
//endregion Getters/Setters
}