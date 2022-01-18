<?php

namespace Evrinoma\StrategyBundle\DependencyInjection\Compiler;

use Evrinoma\StrategyBundle\EvrinomaStrategyBundle;
use Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DecoratorPass extends AbstractRecursivePass
{
//region SECTION: Public
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $decoratorQuery = $container->getParameter(EvrinomaStrategyBundle::VENDOR_PREFIX . '.' . EvrinomaStrategyBundle::STRATEGY_BUNDLE . '.decorates.query');
        if ($decoratorQuery) {
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository = $container->getDefinition(EvrinomaStrategyBundle::VENDOR_PREFIX . '.' . EvrinomaStrategyBundle::STRATEGY_BUNDLE . '.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->getParameter(EvrinomaStrategyBundle::VENDOR_PREFIX . '.' . EvrinomaStrategyBundle::STRATEGY_BUNDLE . '.decorates.command');
        if ($decoratorCommand) {
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager = $container->getDefinition(EvrinomaStrategyBundle::VENDOR_PREFIX . '.' . EvrinomaStrategyBundle::STRATEGY_BUNDLE . '.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }
    }
//endregion Public
}