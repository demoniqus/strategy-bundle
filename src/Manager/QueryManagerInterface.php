<?php

namespace Demoniqus\StrategyBundle\Manager;

use Demoniqus\StrategyBundle\Dto\StrategyApiDtoInterface;
use Demoniqus\StrategyBundle\Exception\StrategyNotFoundException;
use Demoniqus\StrategyBundle\Exception\StrategyProxyException;
use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface;

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