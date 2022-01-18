<?php


use Evrinoma\StrategyBundle\Entity\Strategy\BaseStrategy;
use Evrinoma\UtilsBundle\Validator\AbstractValidator;

class StrategyValidator extends AbstractValidator
{
//region SECTION: Fields
    protected static  ?string $entityClass = BaseStrategy::class;
//endregion Fields

//region SECTION: Constructor
    public function __construct(string $entityClass)
    {
        parent::__construct($entityClass);
    }
//endregion Constructor
}