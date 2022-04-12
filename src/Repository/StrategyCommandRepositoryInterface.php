<?php


namespace Demoniqus\StrategyBundle\Repository;


use Demoniqus\StrategyBundle\Exception\StrategyCannotBeRemovedException;
use Demoniqus\StrategyBundle\Exception\StrategyCannotBeSavedException;
use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface;

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