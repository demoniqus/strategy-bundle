<?php


namespace Demoniqus\StrategyBundle\Factory;


use Demoniqus\StrategyBundle\Dto\StrategyApiDtoInterface;
use Demoniqus\StrategyBundle\Entity\Strategy\BaseStrategy;
use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface;

class StrategyFactory implements StrategyFactoryInterface
{
//region SECTION: Fields
    private static string $entity_class = BaseStrategy::class;
//endregion Fields

//region SECTION: Constructor
    public function __construct(string $entity_class)
    {
        self::$entity_class = $entity_class;
    }
//endregion Constructor

//region SECTION: Public
    public function create(StrategyApiDtoInterface $dto): StrategyInterface
    {
        /** @var BaseStrategy $strategy */
        $strategy = new self::$entity_class;

        $strategy
            ->setType($dto->getType())
            ->setName($dto->getName())
            ->setCreatedAt(new \DateTimeImmutable())
            ->setActiveToActive();


        return $strategy;
    }
//endregion Public
}