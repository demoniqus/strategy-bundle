<?php

namespace Evrinoma\StrategyBundle\Manager;

use Evrinoma\StrategyBundle\Exception\StrategyProxyException;
use Evrinoma\StrategyBundle\Dto\StrategyApiDtoInterface;
use Evrinoma\StrategyBundle\Exception\StrategyNotFoundException;
use Evrinoma\StrategyBundle\Model\Strategy\StrategyInterface;
use Evrinoma\StrategyBundle\Repository\StrategyQueryRepositoryInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use Evrinoma\UtilsBundle\Rest\RestTrait;

final class QueryManager implements QueryManagerInterface, RestInterface
{
    use RestTrait;

//region SECTION: Fields
    private StrategyQueryRepositoryInterface $repository;
//endregion Fields

//region SECTION: Constructor
    public function __construct(StrategyQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return array
     * @throws StrategyNotFoundException
     */
    public function criteria(StrategyApiDtoInterface $dto): array
    {
        try {
            $strategy = $this->repository->findByCriteria($dto);
        } catch (StrategyNotFoundException $e) {
            throw $e;
        }

        return $strategy;
    }

    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return StrategyInterface
     * @throws StrategyProxyException
     */
    public function proxy(StrategyApiDtoInterface $dto): StrategyInterface
    {
        try {
            if ($dto->hasId()) {
                $strategy = $this->repository->proxy($dto->getId());
            }
            else {
                throw new StrategyProxyException("Id value is not set while trying get proxy object");
            }
        } catch (StrategyProxyException $e) {
            throw $e;
        }

        return $strategy;
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getRestStatus(): int
    {
        return $this->status;
    }

    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return StrategyInterface
     * @throws StrategyNotFoundException
     */
    public function get(StrategyApiDtoInterface $dto): StrategyInterface
    {
        try {
            $strategy = $this->repository->find($dto->getId());
        } catch (StrategyNotFoundException $e) {
            throw $e;
        }

        return $strategy;
    }
//endregion Getters/Setters
}