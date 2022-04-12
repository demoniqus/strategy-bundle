<?php


namespace Demoniqus\StrategyBundle\Factory;


use Demoniqus\StrategyBundle\Dto\StrategyApiDtoInterface;
use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface;


interface StrategyFactoryInterface
{
//region SECTION:Public
    public function create(StrategyApiDtoInterface $dto): StrategyInterface;
//endregion Public
}