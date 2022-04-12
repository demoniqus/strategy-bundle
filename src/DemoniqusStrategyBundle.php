<?php

namespace Demoniqus\StrategyBundle;


use Demoniqus\StrategyBundle\DependencyInjection\Compiler\Constraint\StrategyPass;
use Demoniqus\StrategyBundle\DependencyInjection\Compiler\DecoratorPass;
use Demoniqus\StrategyBundle\DependencyInjection\Compiler\MapEntityPass;
use Demoniqus\StrategyBundle\DependencyInjection\DemoniqusStrategyExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DemoniqusStrategyBundle extends Bundle
{
//region SECTION: Fields
    public const STRATEGY_BUNDLE = 'strategy';
    public const VENDOR_PREFIX = 'demoniqus';
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
        return $this->extension ?? ($this->extension = new DemoniqusStrategyExtension());
    }
//endregion Getters/Setters
}