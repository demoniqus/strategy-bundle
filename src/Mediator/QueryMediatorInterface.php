<?php


namespace Demoniqus\StrategyBundle\Mediator;

use Demoniqus\StrategyBundle\Dto\StrategyApiDtoInterface;
use Doctrine\ORM\QueryBuilder;


interface QueryMediatorInterface
{
//region SECTION: Public
    public function alias(): string;

    /**
     * @param StrategyApiDtoInterface $dto
     * @param QueryBuilder            $builder
     */
    public function createQuery(StrategyApiDtoInterface $dto, QueryBuilder $builder): void;
//endregion Public
//region SECTION: Getters/Setters
    /**
     * @param StrategyApiDtoInterface $dto
     * @param QueryBuilder            $builder
     * @return array
     */
    public function getResult(StrategyApiDtoInterface $dto, QueryBuilder $builder): array;
//endregion Getters/Setters
}