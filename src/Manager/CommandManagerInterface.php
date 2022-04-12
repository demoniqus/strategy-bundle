<?php

namespace Demoniqus\StrategyBundle\Manager;

use Demoniqus\StrategyBundle\Dto\StrategyApiDtoInterface;
use Demoniqus\StrategyBundle\Exception\StrategyCannotBeRemovedException;
use Demoniqus\StrategyBundle\Exception\StrategyInvalidException;
use Demoniqus\StrategyBundle\Exception\StrategyNotFoundException;
use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface;

interface CommandManagerInterface
{
    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return StrategyInterface
     * @throws StrategyInvalidException
     */
    public function post(StrategyApiDtoInterface $dto): StrategyInterface;

    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return StrategyInterface
     * @throws StrategyInvalidException
     * @throws StrategyNotFoundException
     */
    public function put(StrategyApiDtoInterface $dto): StrategyInterface;

    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @throws StrategyCannotBeRemovedException
     * @throws StrategyNotFoundException
     */
    public function delete(StrategyApiDtoInterface $dto): void;
}