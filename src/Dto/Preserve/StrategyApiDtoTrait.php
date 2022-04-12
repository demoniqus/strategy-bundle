<?php


namespace Demoniqus\StrategyBundle\Dto\Preserve;


trait StrategyApiDtoTrait
{
//region SECTION: Getters/Setters
    public function setActive(string $active): void
    {
        parent::setActive($active);
    }

    public function setId(?int $id): void
    {
        parent::setId($id);
    }

    public function setName(string $name): void
    {
        parent::setName($name);
    }

    public function setType(string $type): void
    {
        parent::setType($type);
    }
//endregion Getters/Setters
}