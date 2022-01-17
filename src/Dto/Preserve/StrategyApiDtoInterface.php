<?php


namespace App\Strategy\Bundle\Dto\Preserve;


interface StrategyApiDtoInterface
{
//region SECTION:Public

//endregion Public
//region SECTION: Getters/Setters
    public function setActive(string $active): void;

    public function setId(?int $id): void;

    public function setName(string $name): void;

    public function setType(string $type): void;
//endregion Getters/Setters
}