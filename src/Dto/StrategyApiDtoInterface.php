<?php


namespace App\Strategy\Bundle\Dto;


use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\ActiveInterface;
use Evrinoma\DtoCommon\ValueObject\IdInterface;
use Evrinoma\DtoCommon\ValueObject\NameInterface;

interface StrategyApiDtoInterface extends DtoInterface, IdInterface, NameInterface, ActiveInterface
{
//region SECTION:Public

//endregion Public
//region SECTION: Getters/Setters
    public function hasType(): bool;

    public function getType(): string;
//endregion Getters/Setters
}