<?php


namespace Demoniqus\StrategyBundle\Mediator;

use Demoniqus\StrategyBundle\Dto\StrategyApiDtoInterface;
use Demoniqus\StrategyBundle\Exception\StrategyCannotBeCreatedException;
use Demoniqus\StrategyBundle\Exception\StrategyCannotBeRemovedException;
use Demoniqus\StrategyBundle\Exception\StrategyCannotBeSavedException;
use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface;


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
    public function onCreate(StrategyApiDtoInterface $dto, StrategyInterface $entity): StrategyInterface;
//endregion Public
//region SECTION: Getters/Setters

//endregion Getters/Setters
}