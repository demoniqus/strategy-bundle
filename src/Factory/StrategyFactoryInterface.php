<?php


namespace App\Strategy\Bundle\Factory;


use App\Strategy\Bundle\Dto\StrategyApiDtoInterface;
use App\Strategy\Bundle\Model\Strategy\StrategyInterface;


interface StrategyFactoryInterface
{
//region SECTION:Public
    public function create(StrategyApiDtoInterface $dto): StrategyInterface;
//endregion Public
//region SECTION: Getters/Setters

//endregion Getters/Setters
}