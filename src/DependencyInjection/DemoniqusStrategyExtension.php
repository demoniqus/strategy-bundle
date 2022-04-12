<?php

namespace Demoniqus\StrategyBundle\DependencyInjection;

use Demoniqus\StrategyBundle\DependencyInjection\Compiler\Constraint\StrategyPass;
use Demoniqus\StrategyBundle\Dto\StrategyApiDto;
use Demoniqus\StrategyBundle\DemoniqusStrategyBundle;
use Evrinoma\UtilsBundle\DependencyInjection\HelperTrait;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

final class DemoniqusStrategyExtension extends Extension
{
    use HelperTrait;
//region SECTION: Fields
    public const ENTITY         = 'Demoniqus\StrategyBundle\Entity';
    public const ENTITY_FACTORY = 'Demoniqus\StrategyBundle\Factory\StrategyFactory';
    public const ENTITY_BASE    = self::ENTITY.'\Strategy\BaseStrategy';
    public const DTO_BASE       = StrategyApiDto::class;

    /**
     * @var array
     */
    private static array $doctrineDrivers = array(
        'orm' => array(
            'registry' => 'doctrine',
            'tag'      => 'doctrine.event_subscriber',
        ),
    );
//endregion Fields

//region SECTION: Public
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ($container->getParameter('kernel.environment') !== 'prod') {
            $loader->load('fixtures.yml');
        }

        if ($container->getParameter('kernel.environment') === 'test') {
            $loader->load('tests.yml');
        }

        $configuration = $this->getConfiguration($configs, $container);
        $config        = $this->processConfiguration($configuration, $configs);

        if ($config['factory'] !== self::ENTITY_FACTORY) {
            $this->wireFactory($container, $config['factory'], $config['entity']);
        } else {
            $definitionFactory = $container->getDefinition(DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.factory');
            $definitionFactory->setArgument(0, $config['entity']);
        }

        $doctrineRegistry = null;

        if (isset(self::$doctrineDrivers[$config['db_driver']])) {
            $loader->load('doctrine.yml');
            $container->setAlias(
                DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.doctrine_registry',
                new Alias(self::$doctrineDrivers[$config['db_driver']]['registry'], false)
            );
            $doctrineRegistry = new Reference(DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.doctrine_registry');
            $container->setParameter(DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.backend_type_'. $config['db_driver'], true);
            $objectManager = $container->getDefinition(DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.object_manager');
            $objectManager->setFactory([$doctrineRegistry, 'getManager']);
        }

        $this->remapParametersNamespaces(
            $container,
            $config,
            [
                '' => [
                    'db_driver' => DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.storage',
                    'entity'    => DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.entity',
                ],
            ]
        );

        if ($doctrineRegistry) {
            $this->wireRepository($container, $doctrineRegistry, $config['entity']);
        }

        $this->wireController($container, $config['dto']);

        $this->wireValidator($container, $config['entity']);

        $loader->load('validation.yml');

        if ($config['constraints']) {
            $loader->load('constraint/strategy.yml');
        }

        $this->wireConstraintTag($container);

        if ($config['decorates']) {
            $this->remapParametersNamespaces(
                $container,
                $config['decorates'],
                [
                    '' => [
                        'command' => DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.decorates.command',
                        'query'   => DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.decorates.query',
                    ],
                ]
            );
        }


    }

//endregion Public

    private function wireConstraintTag(ContainerBuilder $container): void
    {
        foreach ($container->getDefinitions() as $key => $definition) {
            switch (true) {
                case strpos($key, StrategyPass::STRATEGY_CONSTRAINT) !== false :
                    $definition->addTag(StrategyPass::STRATEGY_CONSTRAINT);
                    break;
                default:
            }
        }
    }

    private function wireRepository(ContainerBuilder $container, Reference $doctrineRegistry, string $class): void
    {
        $definitionRepository    = $container->getDefinition(DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.repository');
        $definitionQueryMediator = $container->getDefinition(DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.query.mediator');
        $definitionRepository->setArgument(0, $doctrineRegistry);
        $definitionRepository->setArgument(1, $class);
        $definitionRepository->setArgument(2, $definitionQueryMediator);
    }

    private function wireFactory(ContainerBuilder $container, string $class, string $paramClass): void
    {
        $container->removeDefinition(DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.factory');
        $definitionFactory = new Definition($class);
        $definitionFactory->addArgument($paramClass);
        $alias = new Alias(DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.factory');
        $container->addDefinitions([DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.factory' => $definitionFactory]);
        $container->addAliases([$class => $alias]);
    }

    private function wireController(ContainerBuilder $container, string $class): void
    {
        $definitionApiController = $container->getDefinition(DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.api.controller');
        $definitionApiController->setArgument(5, $class);
    }

    private function wireValidator(ContainerBuilder $container, string $class): void
    {
        $definitionApiController = $container->getDefinition(DemoniqusStrategyBundle::VENDOR_PREFIX . '.'.$this->getAlias().'.validator');
        $definitionApiController->setArgument(0, $class);
    }

//region SECTION: Getters/Setters
    public function getAlias()
    {
        return DemoniqusStrategyBundle::STRATEGY_BUNDLE;
    }
//endregion Getters/Setters
}