<?php

namespace Evrinoma\StrategyBundle\Manager;

use Evrinoma\StrategyBundle\Dto\StrategyApiDtoInterface;
use Evrinoma\StrategyBundle\Exception\StrategyCannotBeRemovedException;
use Evrinoma\StrategyBundle\Exception\StrategyInvalidException;
use Evrinoma\StrategyBundle\Exception\StrategyNotFoundException;
use Evrinoma\StrategyBundle\Model\Strategy\StrategyInterface;

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