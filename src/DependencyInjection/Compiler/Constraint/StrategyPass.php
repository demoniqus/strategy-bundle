<?php

namespace Demoniqus\StrategyBundle\DependencyInjection\Compiler\Constraint;

use Demoniqus\StrategyBundle\DemoniqusStrategyBundle;
use Demoniqus\StrategyBundle\Validator\StrategyValidator;
use Evrinoma\UtilsBundle\Exception\ConstraintCannotBeCompiledException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class StrategyPass implements CompilerPassInterface
{
//region SECTION: Fields
        public const STRATEGY_PROPERTY_CONSTRAINT = DemoniqusStrategyBundle::VENDOR_PREFIX . '.' . DemoniqusStrategyBundle::STRATEGY_LC . '.constraint.property';
        public const STRATEGY_COMPLEX_CONSTRAINT = DemoniqusStrategyBundle::VENDOR_PREFIX . '.' . DemoniqusStrategyBundle::STRATEGY_LC . '.constraint.complex';
        public const STRATEGY_CONSTRAINTS = [
            self::STRATEGY_PROPERTY_CONSTRAINT,
            self::STRATEGY_COMPLEX_CONSTRAINT,
        ];

        protected const CONSTRAINT_SETTINGS = [
            self::STRATEGY_PROPERTY_CONSTRAINT => [
                'validatorClass' => StrategyValidator::class,
                'methodCall' => 'addPropertyConstraint',
            ],
            self::STRATEGY_COMPLEX_CONSTRAINT => [
                'validatorClass' => StrategyValidator::class,
                'methodCall' => 'addConstraint',
            ],
        ];

//endregion Fields
//region SECTION: Private
    /**
     * @param ContainerBuilder $container
     * @param string           $constraintAlias
     * @param string           $validatorClass
     * @param string           $methodCall
     * @throws ConstraintCannotBeCompiledException
     */
    private function processConstraintType(
        ContainerBuilder $container,
        string $constraintAlias,
        string $validatorClass,
        string $methodCall
    ): void
    {
        if ($constraintAlias === '' || $validatorClass ==='' || $methodCall ==='') {
            throw new ConstraintCannotBeCompiledException();
        }

        if (!$container->has($validatorClass)) {
            return;
        }

        $definition = $container->findDefinition($validatorClass);

        $taggedServices = $container->findTaggedServiceIds($constraintAlias);

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall($methodCall, [new Reference($id)]);
        }
    }
//endregion Private
//region SECTION: Public
    /**
     * @inheritDoc
     * @throws ConstraintCannotBeCompiledException
     */
    public function process(ContainerBuilder $container)
    {
        foreach (static::CONSTRAINT_SETTINGS as $constraintAlias => $constraintSettings) {
            $this->processConstraintType(
                $container,
                $constraintAlias,
                $constraintSettings['validatorClass'],
                $constraintSettings['methodCall']
            );
        }
    }
//endregion Public
}