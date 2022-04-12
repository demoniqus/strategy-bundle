<?php

namespace Demoniqus\StrategyBundle\Tests\Functional;

use Evrinoma\TestUtilsBundle\Kernel\AbstractApiKernel;

/**
 * Kernel
 */
class Kernel extends AbstractApiKernel
{
//region SECTION: Fields
    protected string $bundlePrefix = 'StrategyBundle';
    protected string $rootDir = __DIR__;
//endregion Fields

//region SECTION: Public
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return array_merge(parent::registerBundles(), [new \Evrinoma\DtoBundle\EvrinomaDtoBundle(), new \Demoniqus\StrategyBundle\DemoniqusStrategyBundle()]);
    }

    protected function getBundleConfig(): array
    {
        return  ['framework.yaml', 'jms_serializer.yaml'];
    }

}
