<?php


namespace Evrinoma\StrategyBundle\Mediator;

use Evrinoma\StrategyBundle\Dto\StrategyApiDtoInterface;
use Doctrine\ORM\QueryBuilder;


interface QueryMediatorInterface
{
//region SECTION: Public
    public function alias(): string;

    public function createQuery(StrategyApiDtoInterface $dto, QueryBuilder $builder): void;
//endregion Public
//region SECTION: Getters/Setters
    public function getResult(StrategyApiDtoInterface $dto, QueryBuilder $builder): array;
//endregion Getters/Setters
}