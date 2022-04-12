<?php


namespace Demoniqus\StrategyBundle\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\Persistence\ManagerRegistry;
use Demoniqus\StrategyBundle\Dto\StrategyApiDtoInterface;
use Demoniqus\StrategyBundle\Exception\StrategyCannotBeSavedException;
use Demoniqus\StrategyBundle\Exception\StrategyNotFoundException;
use Demoniqus\StrategyBundle\Exception\StrategyProxyException;
use Demoniqus\StrategyBundle\Mediator\QueryMediatorInterface;
use Demoniqus\StrategyBundle\Model\Strategy\StrategyInterface;

class StrategyRepository extends ServiceEntityRepository implements StrategyRepositoryInterface
{
//region SECTION: Fields
    private QueryMediatorInterface $mediator;
//endregion Fields

//region SECTION: Constructor
    /**
     * @param ManagerRegistry        $registry
     * @param string                 $entityClass
     * @param QueryMediatorInterface $mediator
     */
    public function __construct(ManagerRegistry $registry, string $entityClass, QueryMediatorInterface $mediator)
    {
        parent::__construct($registry, $entityClass);
        $this->mediator = $mediator;
    }
//endregion Constructor

    //region SECTION: Public

    /**
     * @param StrategyInterface $strategy
     *
     * @return bool
     * @throws StrategyCannotBeSavedException
     * @throws ORMException
     */
    public function save(StrategyInterface $strategy): bool
    {
        try {
            $this->getEntityManager()->persist($strategy);
        } catch (ORMInvalidArgumentException $e) {
            throw new StrategyCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param StrategyInterface $strategy
     *
     * @return bool
     */
    public function remove(StrategyInterface $strategy): bool
    {
        $strategy->setActiveToDelete();

        return true;
    }

    /**
     * @param string $id
     *
     * @return StrategyInterface
     * @throws StrategyProxyException
     * @throws ORMException
     */
    public function proxy(string $id): StrategyInterface
    {
        $em = $this->getEntityManager();

        $strategy = $em->getReference($this->getEntityName(), $id);

        if (!$em->contains($strategy)) {
            throw new StrategyProxyException("Proxy doesn't exist with $id");
        }

        return $strategy;
    }
//endregion Public

//region SECTION: Find Filters Repository
    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return array
     * @throws StrategyNotFoundException
     */
    public function findByCriteria(StrategyApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilder($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $strategies = $this->mediator->getResult($dto, $builder);

        if (count($strategies) === 0) {
            throw new StrategyNotFoundException("Cannot find strategy by findByCriteria");
        }

        return $strategies;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     * @throws StrategyNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): StrategyInterface
    {
        /** @var StrategyInterface $strategy */
        $strategy = parent::find($id);

        if ($strategy === null) {
            throw new StrategyNotFoundException("Cannot find strategy with id $id");
        }

        return $strategy;
    }
//endregion Find Filters Repository
}