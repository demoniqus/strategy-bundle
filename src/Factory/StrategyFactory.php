<?php


namespace App\Strategy\Bundle\Factory;


use App\Strategy\Bundle\Dto\StrategyApiDtoInterface;
use App\Strategy\Bundle\Entity\Strategy\BaseStrategy;
use App\Strategy\Bundle\Model\Strategy\StrategyInterface;

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

//region SECTION: Protected

//endregion Protected

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

//region SECTION: Getters/Setters

//endregion Getters/Setters
}