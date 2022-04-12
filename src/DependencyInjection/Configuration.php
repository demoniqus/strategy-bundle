<?php

namespace Demoniqus\StrategyBundle\DependencyInjection;


use Demoniqus\StrategyBundle\DemoniqusStrategyBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
//region SECTION: Getters/Setters
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder      = new TreeBuilder(DemoniqusStrategyBundle::STRATEGY_BUNDLE);
        $rootNode         = $treeBuilder->getRootNode();
        $supportedDrivers = ['orm'];

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('db_driver')
            ->validate()
            ->ifNotInArray($supportedDrivers)
            ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
            ->end()
            ->cannotBeOverwritten()
            ->defaultValue('orm')
            ->end()
            ->scalarNode('factory')->cannotBeEmpty()->defaultValue(DemoniqusStrategyExtension::ENTITY_FACTORY)->end()
            ->scalarNode('entity')->cannotBeEmpty()->defaultValue(DemoniqusStrategyExtension::ENTITY_BASE)->end()
            ->scalarNode('constraints')->defaultTrue()->info('This option is used for enable/disable basic strategy constraints')->end()
            ->scalarNode('dto')->cannotBeEmpty()->defaultValue(DemoniqusStrategyExtension::DTO_BASE)->info('This option is used for dto class override')->end()
            ->arrayNode('decorates')->addDefaultsIfNotSet()->children()
            ->scalarNode('command')->defaultNull()->info('This option is used for command strategy decoration')->end()
            ->scalarNode('query')->defaultNull()->info('This option is used for query strategy decoration')->end()
            ->end()->end()->end();

        return $treeBuilder;
    }
//endregion Getters/Setters
}