<?php

namespace Demoniqus\StrategyBundle\DependencyInjection\Compiler\Constraint;

use Demoniqus\StrategyBundle\DemoniqusStrategyBundle;
use Demoniqus\StrategyBundle\Validator\StrategyValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class StrategyPass extends AbstractConstraint implements CompilerPassInterface
{
//region SECTION: Fields
        public const STRATEGY_CONSTRAINT = DemoniqusStrategyBundle::VENDOR_PREFIX . '.' . DemoniqusStrategyBundle::STRATEGY_LC . '.constraint';

        protected static string $alias = self::STRATEGY_CONSTRAINT;
        protected static string $class = StrategyValidator::class;
        protected static string $methodCall = 'addConstraint';

//endregion Fields
}