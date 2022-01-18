<?php


namespace Evrinoma\StrategyBundle\Repository;


use Evrinoma\StrategyBundle\Exception\StrategyCannotBeRemovedException;
use Evrinoma\StrategyBundle\Exception\StrategyCannotBeSavedException;
use Evrinoma\StrategyBundle\Model\Strategy\StrategyInterface;

interface StrategyCommandRepositoryInterface
{
//region SECTION:Public
    /**
     * @param StrategyInterface $strategy
     * @return bool
     * @throws StrategyCannotBeSavedException
     */
    public function save(StrategyInterface $strategy): bool;

    /**
     * @param StrategyInterface $strategy
     * @return bool
     * @throws StrategyCannotBeRemovedException
     */
    public function remove(StrategyInterface $strategy): bool;
//endregion Public
}