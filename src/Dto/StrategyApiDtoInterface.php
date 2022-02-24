<?php


namespace Evrinoma\StrategyBundle\Dto;


use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\ActiveInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\NameInterface;

interface StrategyApiDtoInterface extends DtoInterface, IdInterface, NameInterface, ActiveInterface
{
//region SECTION:Public

//endregion Public
//region SECTION: Getters/Setters
    public function hasType(): bool;

    public function getType(): string;
//endregion Getters/Setters
}