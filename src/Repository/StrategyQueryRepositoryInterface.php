<?php


namespace Evrinoma\StrategyBundle\Repository;


use Doctrine\ORM\Exception\ORMException;
use Evrinoma\StrategyBundle\Dto\StrategyApiDtoInterface;
use Evrinoma\StrategyBundle\Exception\StrategyNotFoundException;
use Evrinoma\StrategyBundle\Exception\StrategyProxyException;
use Evrinoma\StrategyBundle\Model\Strategy\StrategyInterface;

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