<?php

namespace Demoniqus\StrategyBundle\Tests\Functional\Controller;


use Demoniqus\StrategyBundle\DemoniqusStrategyBundle;
use Demoniqus\StrategyBundle\Fixtures\FixtureInterface;
use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;
use Evrinoma\TestUtilsBundle\Functional\AbstractFunctionalTest;
use Psr\Container\ContainerInterface;

/**
 * @group functional
 */
final class ApiControllerTest extends AbstractFunctionalTest
{
//region SECTION: Fields
    protected string $actionServiceName = DemoniqusStrategyBundle::VENDOR_PREFIX . '.' . DemoniqusStrategyBundle::STRATEGY_LC . '.test.functional.action.' . DemoniqusStrategyBundle::STRATEGY_LC;
//endregion Fields

//region SECTION: Protected
    protected function getActionService(ContainerInterface $container): ActionTestInterface
    {
        return $container->get($this->actionServiceName);
    }
//endregion Protected

//region SECTION: Getters/Setters
    public static function getFixtures(): array
    {
        return [FixtureInterface::STRATEGY_FIXTURES];
    }
//endregion Getters/Setters
}