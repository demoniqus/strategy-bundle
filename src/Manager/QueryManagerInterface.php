<?php

namespace Evrinoma\StrategyBundle\Manager;

use Evrinoma\StrategyBundle\Dto\StrategyApiDtoInterface;
use Evrinoma\StrategyBundle\Exception\StrategyNotFoundException;
use Evrinoma\StrategyBundle\Exception\StrategyProxyException;
use Evrinoma\StrategyBundle\Model\Strategy\StrategyInterface;

interface QueryManagerInterface
{
    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return array
     * @throws StrategyNotFoundException
     */
    public function criteria(StrategyApiDtoInterface $dto): array;
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return StrategyInterface
     * @throws StrategyNotFoundException
     */
    public function get(StrategyApiDtoInterface $dto): StrategyInterface;

    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return StrategyInterface
     * @throws StrategyProxyException
     */
    public function proxy(StrategyApiDtoInterface $dto): StrategyInterface;
}