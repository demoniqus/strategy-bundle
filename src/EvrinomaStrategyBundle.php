<?php

namespace Evrinoma\StrategyBundle;


use Evrinoma\StrategyBundle\DependencyInjection\Compiler\Constraint\StrategyPass;
use Evrinoma\StrategyBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\StrategyBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\StrategyBundle\DependencyInjection\EvrinomaStrategyExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaStrategyBundle extends Bundle
{
//region SECTION: Fields
    public const STRATEGY_BUNDLE = 'strategy';
    public const VENDOR_PREFIX = 'evrinoma';
//endregion Fields

//region SECTION: Constructor

//endregion Constructor

//region SECTION: Protected

//endregion Protected

//region SECTION: Public
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass( new DecoratorPass())
            ->addCompilerPass(new StrategyPass())
            ;
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getContainerExtension()
    {
        return $this->extension ?? ($this->extension = new EvrinomaStrategyExtension());
    }
//endregion Getters/Setters
}