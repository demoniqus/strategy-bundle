<?php

namespace Demoniqus\StrategyBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Demoniqus\StrategyBundle\Entity\Strategy\BaseStrategy;
use Demoniqus\StrategyBundle\Fixtures\Strategies\BudgetCalcByEstimateStrategy;
use Demoniqus\StrategyBundle\Fixtures\Strategies\BudgetCalcByStageStrategy;
use Demoniqus\StrategyBundle\Fixtures\Strategies\DashedEstimateGenNumberStrategy;
use Demoniqus\StrategyBundle\Fixtures\Strategies\DotedEstimateGenNumberStrategy;
use Demoniqus\StrategyBundle\Fixtures\Strategies\SlashedEstimateGenNumberStrategy;

class StrategyFixtures extends Fixture implements OrderedFixtureInterface, FixtureGroupInterface
{
//region SECTION: Private
    /**
     * @return string[][]
     */
    private function getData(): array
    {
        return [
            [
                'active' => 'a', 'created_at' => '2010-01-01 00:00:00',
                'name'   => BudgetCalcByEstimateStrategy::class,
                'type'   => BudgetCalcByEstimateStrategy::getType(),
            ],
            [
                'active' => 'a', 'created_at' => '2010-01-02 01:00:00',
                'name'   => BudgetCalcByStageStrategy::class,
                'type'   => BudgetCalcByStageStrategy::getType(),
            ],
            [
                'active' => 'a', 'created_at' => '2010-01-03 02:00:00',
                'name'   => DashedEstimateGenNumberStrategy::class,
                'type'   => DashedEstimateGenNumberStrategy::getType(),
            ],
            [
                'active' => 'a', 'created_at' => '2010-01-04 03:00:00',
                'name'   => DotedEstimateGenNumberStrategy::class,
                'type'   => DotedEstimateGenNumberStrategy::getType(),
            ],
            [
                'active' => 'a', 'created_at' => '2010-01-05 04:00:00',
                'name'   => SlashedEstimateGenNumberStrategy::class,
                'type'   => SlashedEstimateGenNumberStrategy::getType(),
            ],
        ];
    }

    private function create(ObjectManager $manager): void
    {
        $short = (new \ReflectionClass(BaseStrategy::class))->getShortName() . "_";
        $i = 0;

        foreach ($this->getData() as $record) {
            $entity = new BaseStrategy();
            $entity
                ->setType($record['type'])
                ->setName($record['name'])
                ->setCreatedAt(new \DateTimeImmutable($record['created_at']))
                ->setActive($record['active']);

            $this->addReference($short . $i, $entity);
            $manager->persist($entity);
            $i++;
        }
    }
//endregion Private

//region SECTION: Public
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->create($manager);

        $manager->flush();
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getOrder(): int
    {
        return 0;
    }

    public static function getGroups(): array
    {
        return [FixtureInterface::STRATEGY_FIXTURES,];
    }
//endregion Getters/Setters
}