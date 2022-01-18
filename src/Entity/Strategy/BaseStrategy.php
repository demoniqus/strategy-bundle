<?php


namespace Evrinoma\StrategyBundle\Entity\Strategy;


use Evrinoma\StrategyBundle\Model\Strategy\AbstractStrategy;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="e_strategy")
 * @ORM\Entity()
 */
final class BaseStrategy extends AbstractStrategy
{
}