<?php

namespace Demoniqus\StrategyBundle\DependencyInjection\Compiler;

use Demoniqus\StrategyBundle\DependencyInjection\DemoniqusStrategyExtension;
use Demoniqus\StrategyBundle\Entity\Strategy\BaseStrategy;
use Demoniqus\StrategyBundle\DemoniqusStrategyBundle;
use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface;
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

        $this->cleanMetadata($driver, [DemoniqusStrategyExtension::ENTITY]);

        $entity = $container->getParameter(DemoniqusStrategyBundle::VENDOR_PREFIX . '.strategy.entity');
        if ((strpos($entity, DemoniqusStrategyExtension::ENTITY) !== false)) {
            $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Strategy', '%s/Entity/Strategy');
            $this->addResolveTargetEntity([BaseStrategy::class => StrategyInterface::class,], false);
        }
    }
//endregion Public
}