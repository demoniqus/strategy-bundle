<?php


namespace App\Strategy\Bundle\Mediator;


use App\Strategy\Bundle\Model\Strategy\StrategyInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
//region SECTION: Fields

//endregion Fields

//region SECTION: Constructor

//endregion Constructor

//region SECTION: Protected

//endregion Protected

//region SECTION: Public
    public function onUpdate(DtoInterface $dto, $entity): StrategyInterface
    {
        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {

    }

    public function onCreate(DtoInterface $dto, $entity): StrategyInterface
    {
        return $entity;
    }
//endregion Public

//region SECTION: Getters/Setters

//endregion Getters/Setters
}