<?php

namespace Demoniqus\StrategyBundle\DependencyInjection\Compiler;

use Demoniqus\StrategyBundle\DemoniqusStrategyBundle;
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
        $decoratorQuery = $container->getParameter(DemoniqusStrategyBundle::VENDOR_PREFIX . '.' . DemoniqusStrategyBundle::STRATEGY_LC . '.decorates.query');
        if ($decoratorQuery) {
            $queryMediator = $container->getDefinition($decoratorQuery);
            $repository = $container->getDefinition(DemoniqusStrategyBundle::VENDOR_PREFIX . '.' . DemoniqusStrategyBundle::STRATEGY_LC . '.repository');
            $repository->setArgument(2, $queryMediator);
        }
        $decoratorCommand = $container->getParameter(DemoniqusStrategyBundle::VENDOR_PREFIX . '.' . DemoniqusStrategyBundle::STRATEGY_LC . '.decorates.command');
        if ($decoratorCommand) {
            $commandMediator = $container->getDefinition($decoratorCommand);
            $commandManager = $container->getDefinition(DemoniqusStrategyBundle::VENDOR_PREFIX . '.' . DemoniqusStrategyBundle::STRATEGY_LC . '.command.manager');
            $commandManager->setArgument(3, $commandMediator);
        }
    }
//endregion Public
}