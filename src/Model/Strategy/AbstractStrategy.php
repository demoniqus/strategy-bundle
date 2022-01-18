<?php


namespace Evrinoma\StrategyBundle\Model\Strategy;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\ActiveTrait;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtTrait;
use Evrinoma\UtilsBundle\Entity\IdTrait;


/**
 * @ORM\MappedSuperclass
 * @ORM\Table(uniqueConstraints={
 *     @ORM\UniqueConstraint(name="idx_name", columns={"name"})
 *     }
 * )
 */
abstract class AbstractStrategy implements StrategyInterface
{
    use IdTrait, CreateUpdateAtTrait, ActiveTrait;
//region SECTION: Fields
    /**
     * Полное наименование конкретного класса, реализующего стратегию заданного типа (например, расчет бюджета по сметам или по этапам).
     * Данный класс должен реализовать интерфейс Interfaces\StrategyInterface
     *
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected string $name;
    /**
     * Тип стратегии (например, стратегия расчета бюджета, стратегия формирования номера сметы)
     *
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    protected string $type;
//endregion Fields

//region SECTION: Constructor

//endregion Constructor

//region SECTION: Protected

//endregion Protected

//region SECTION: Public

//endregion Public

//region SECTION: Getters/Setters
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

//endregion Getters/Setters
}