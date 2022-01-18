<?php


namespace Evrinoma\StrategyBundle\Model\Strategy;


use Evrinoma\UtilsBundle\Entity\ActiveInterface;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtInterface;
use Evrinoma\UtilsBundle\Entity\IdInterface;

/**
 * Strategy as database record
 */
interface StrategyInterface extends ActiveInterface, CreateUpdateAtInterface, IdInterface
{
//region SECTION:Public

//endregion Public
//region SECTION: Getters/Setters
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $name
     *
     * @return $this
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setName(string $name);

    /**
     * @param string $type
     *
     * @return $this
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setType(string $type);
//endregion Getters/Setters
}