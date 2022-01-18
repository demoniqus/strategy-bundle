<?php


namespace Evrinoma\StrategyBundle\Mediator;

use Evrinoma\StrategyBundle\Dto\StrategyApiDtoInterface;
use Evrinoma\StrategyBundle\Exception\StrategyCannotBeCreatedException;
use Evrinoma\StrategyBundle\Exception\StrategyCannotBeRemovedException;
use Evrinoma\StrategyBundle\Exception\StrategyCannotBeSavedException;
use Evrinoma\StrategyBundle\Model\Strategy\StrategyInterface;


interface CommandMediatorInterface
{
//region SECTION:Public
    /**
     * @param StrategyApiDtoInterface $dto
     * @param StrategyInterface       $entity
     *
     * @return StrategyInterface
     * @throws StrategyCannotBeSavedException
     */
    public function onUpdate(StrategyApiDtoInterface $dto, StrategyInterface $entity): StrategyInterface;

    /**
     * @param StrategyApiDtoInterface $dto
     * @param StrategyInterface       $entity
     *
     * @throws StrategyCannotBeRemovedException
     */
    public function onDelete(StrategyApiDtoInterface $dto, StrategyInterface $entity): void;

    /**
     * @param StrategyApiDtoInterface $dto
     * @param StrategyInterface       $entity
     *
     * @return StrategyInterface
     * @throws StrategyCannotBeCreatedException
     */
    public function onCreate (StrategyApiDtoInterface $dto, StrategyInterface $entity): StrategyInterface;
//endregion Public
//region SECTION: Getters/Setters

//endregion Getters/Setters
}