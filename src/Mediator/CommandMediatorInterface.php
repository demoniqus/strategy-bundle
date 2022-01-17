<?php


namespace App\Strategy\Bundle\Mediator;

use App\Strategy\Bundle\Dto\StrategyApiDtoInterface;
use App\Strategy\Bundle\Exception\StrategyCannotBeCreatedException;
use App\Strategy\Bundle\Exception\StrategyCannotBeRemovedException;
use App\Strategy\Bundle\Exception\StrategyCannotBeSavedException;
use App\Strategy\Bundle\Model\Strategy\StrategyInterface;


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