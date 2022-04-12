<?php


namespace Demoniqus\StrategyBundle\Repository;


use Doctrine\ORM\Exception\ORMException;
use Demoniqus\StrategyBundle\Dto\StrategyApiDtoInterface;
use Demoniqus\StrategyBundle\Exception\StrategyNotFoundException;
use Demoniqus\StrategyBundle\Exception\StrategyProxyException;
use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface;

interface StrategyQueryRepositoryInterface
{
    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return array
     * @throws StrategyNotFoundException
     */
    public function findByCriteria(StrategyApiDtoInterface $dto): array;

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return StrategyInterface
     * @throws StrategyNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): StrategyInterface;

    /**
     * @param string $id
     *
     * @return StrategyInterface
     * @throws StrategyProxyException
     * @throws ORMException
     */
    public function proxy(string $id): StrategyInterface;
}