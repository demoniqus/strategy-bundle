<?php

namespace Demoniqus\StrategyBundle\Validator;


use Demoniqus\StrategyBundle\Entity\Strategy\BaseStrategy;
use Evrinoma\UtilsBundle\Validator\AbstractValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class StrategyValidator extends AbstractValidator
{
//region SECTION: Fields
    protected static ?string $entityClass = BaseStrategy::class;
//endregion Fields

//region SECTION: Constructor
    public function __construct(ValidatorInterface $validator, string $entityClass)
    {
        parent::__construct($validator, $entityClass);
    }
//endregion Constructor
}