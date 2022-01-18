<?php

namespace Evrinoma\StrategyBundle\DependencyInjection\Compiler;

use Evrinoma\StrategyBundle\DependencyInjection\EvrinomaStrategyExtension;
use Evrinoma\StrategyBundle\Entity\Strategy\BaseStrategy;
use Evrinoma\StrategyBundle\EvrinomaStrategyBundle;
use Evrinoma\StrategyBundle\Model\Strategy\StrategyInterface;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractMapEntity;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MapEntityPass extends AbstractMapEntity implements CompilerPassInterface
{
//region SECTION: Public
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $this->setContainer($container);

        $driver                    = $container->findDefinition('doctrine.orm.default_metadata_driver');
        $referenceAnnotationReader = new Reference('annotations.reader');

        $this->cleanMetadata($driver, [EvrinomaStrategyExtension::ENTITY]);

        $entity = $container->getParameter(EvrinomaStrategyBundle::VENDOR_PREFIX . '.strategy.entity');
        if ((strpos($entity, EvrinomaStrategyExtension::ENTITY) !== false)) {
            $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Strategy', '%s/Entity/Strategy');
            $this->addResolveTargetEntity([BaseStrategy::class => StrategyInterface::class,], false);
        }
    }
//endregion Public
}