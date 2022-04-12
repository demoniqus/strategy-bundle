<?php


namespace Demoniqus\StrategyBundle\Mediator;


use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
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
}