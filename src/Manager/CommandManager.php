<?php

namespace Evrinoma\StrategyBundle\Manager;

use Evrinoma\StrategyBundle\Exception\StrategyCannotBeCreatedException;
use Evrinoma\StrategyBundle\Exception\StrategyCannotBeRemovedException;
use Evrinoma\StrategyBundle\Dto\StrategyApiDtoInterface;
use Evrinoma\StrategyBundle\Exception\StrategyCannotBeSavedException;
use Evrinoma\StrategyBundle\Exception\StrategyInvalidException;
use Evrinoma\StrategyBundle\Exception\StrategyNotFoundException;
use Evrinoma\StrategyBundle\Factory\StrategyFactoryInterface;
use Evrinoma\StrategyBundle\Mediator\CommandMediatorInterface;
use Evrinoma\StrategyBundle\Model\Strategy\StrategyInterface;
use Evrinoma\StrategyBundle\Repository\StrategyCommandRepositoryInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use Evrinoma\UtilsBundle\Rest\RestTrait;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface, RestInterface
{
    use RestTrait;

//region SECTION: Fields
    private StrategyCommandRepositoryInterface $repository;
    private ValidatorInterface                 $validator;
    private StrategyFactoryInterface           $factory;
    private CommandMediatorInterface           $mediator;
//endregion Fields

//region SECTION: Constructor


    /**
     * @param ValidatorInterface                 $validator
     * @param StrategyCommandRepositoryInterface $repository
     * @param StrategyFactoryInterface           $factory
     * @param CommandMediatorInterface           $mediator
     */
    public function __construct(
        ValidatorInterface                 $validator,
        StrategyCommandRepositoryInterface $repository,
        StrategyFactoryInterface           $factory,
        CommandMediatorInterface           $mediator
    ) {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return StrategyInterface
     * @throws StrategyInvalidException|StrategyCannotBeCreatedException
     */
    public function post(StrategyApiDtoInterface $dto): StrategyInterface
    {
        $strategy = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $strategy);

        $errors = $this->validator->validate($strategy);

        if (count($errors) > 0) {

            $errorsString = (string)$errors;

            throw new StrategyInvalidException($errorsString);
        }

        $this->repository->save($strategy);

        return $strategy;
    }

    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @return StrategyInterface
     * @throws StrategyInvalidException
     * @throws StrategyNotFoundException|StrategyCannotBeSavedException
     */
    public function put(StrategyApiDtoInterface $dto): StrategyInterface
    {
        try {
            $strategy = $this->repository->find($dto->getId());
        } catch (StrategyNotFoundException $e) {
            throw $e;
        }

        $strategy
            ->setName($dto->getName())
            ->setType($dto->getType())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setActive($dto->getActive());


        $this->mediator->onUpdate($dto, $strategy);

        $errors = $this->validator->validate($strategy);

        if (count($errors) > 0) {

            $errorsString = (string)$errors;

            throw new StrategyInvalidException($errorsString);
        }

        $this->repository->save($strategy);

        return $strategy;
    }

    /**
     * @param StrategyApiDtoInterface $dto
     *
     * @throws StrategyCannotBeRemovedException
     * @throws StrategyNotFoundException
     */
    public function delete(StrategyApiDtoInterface $dto): void
    {
        try {
            $strategy = $this->repository->find($dto->getId());
        } catch (StrategyNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $strategy);
        try {
            $this->repository->remove($strategy);
        } catch (StrategyCannotBeRemovedException $e) {
            throw $e;
        }
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getRestStatus(): int
    {
        return $this->status;
    }
//endregion Getters/Setters
}