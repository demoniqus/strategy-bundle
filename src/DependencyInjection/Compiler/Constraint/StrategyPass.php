<?php

namespace Evrinoma\StrategyBundle\DependencyInjection\Compiler\Constraint;

use Evrinoma\StrategyBundle\EvrinomaStrategyBundle;
use Evrinoma\StrategyBundle\Validator\StrategyValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class StrategyPass extends AbstractConstraint implements CompilerPassInterface
{
//region SECTION: Fields
        public const STRATEGY_CONSTRAINT = EvrinomaStrategyBundle::VENDOR_PREFIX . '.strategy.constraint';

        protected static string $alias = self::STRATEGY_CONSTRAINT;
        protected static string $class = StrategyValidator::class;
        protected static string $methodCall = 'addConstraint';

//endregion Fields
}