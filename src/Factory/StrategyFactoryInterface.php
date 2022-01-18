<?php


namespace Evrinoma\StrategyBundle\Factory;


use Evrinoma\StrategyBundle\Dto\StrategyApiDtoInterface;
use Evrinoma\StrategyBundle\Model\Strategy\StrategyInterface;


interface StrategyFactoryInterface
{
//region SECTION:Public
    public function create(StrategyApiDtoInterface $dto): StrategyInterface;
//endregion Public
//region SECTION: Getters/Setters

//endregion Getters/Setters
}