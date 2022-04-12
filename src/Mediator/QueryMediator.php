<?php


namespace Demoniqus\StrategyBundle\Mediator;


use Demoniqus\StrategyBundle\Dto\StrategyApiDtoInterface;
use Demoniqus\StrategyBundle\Repository\AliasInterface;
use Doctrine\ORM\QueryBuilder;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractQueryMediator;

class QueryMediator extends AbstractQueryMediator implements QueryMediatorInterface
{
//region SECTION: Fields
    protected static string $alias = AliasInterface::STRATEGY;
//endregion Fields

//region SECTION: Public
    /**
     * @param DtoInterface $dto
     * @param QueryBuilder $builder
     *
     * @return mixed
     */
    public function createQuery(DtoInterface $dto, QueryBuilder $builder): void
    {
        $alias = $this->alias();

        /** @var $dto StrategyApiDtoInterface */
        if ($dto->hasId()) {
            $builder
                ->andWhere($alias . '.id = :id')
                ->setParameter('id', $dto->getId());
        }

        if ($dto->hasType()) {
            $builder
                ->andWhere($alias . '.type = :type')
                ->setParameter('type', $dto->getType());
        }

        if ($dto->hasName()) {
            $builder
                ->andWhere($alias . '.name = :name')
                ->setParameter('name', $dto->getName());
        }

        if ($dto->hasActive()) {
            $builder
                ->andWhere($alias . '.active = :active')
                ->setParameter('active', $dto->getActive());
        }
    }
//endregion Public
}