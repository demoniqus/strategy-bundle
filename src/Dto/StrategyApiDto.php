<?php


namespace Demoniqus\StrategyBundle\Dto;


use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoCommon\ValueObject\Immutable\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdTrait;
use Evrinoma\DtoCommon\ValueObject\Immutable\NameTrait;
use Demoniqus\StrategyBundle\Model\ModelInterface;
use Symfony\Component\HttpFoundation\Request;

class StrategyApiDto extends AbstractDto implements StrategyApiDtoInterface
{
    use IdTrait, ActiveTrait, NameTrait;

//region SECTION: Fields
    private string $type;
//endregion Fields

//region SECTION: Constructor

//endregion Constructor

//region SECTION: Protected
    protected function setActive(string $active): void
    {
        $this->active = $active;
    }


    /**
     * @param int|null $id
     */
    protected function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    protected function setName(string $name): void
    {
        $this->name = $name;
    }

    protected function setType(string $type): void
    {
        $this->type = $type;
    }
//endregion Protected


//region SECTION: Dto
    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id     = $request->get(ModelInterface::ID);
            $name   = $request->get(ModelInterface::NAME);
            $active = $request->get(ModelInterface::ACTIVE);
            $type   = $request->get(ModelInterface::TYPE);

            if ($active) {
                $this->setActive($active);
            }

            if ($type) {
                $this->setType($type);
            }

            if ($name) {
                $this->setName($name);
            }

            if ($id) {
                $this->setId($id);
            }
        }

        return $this;
    }
//endregion SECTION: Dto
//region SECTION: Getters/Setters
    public function hasType(): bool
    {
        return !!$this->type;
    }

    public function getType(): string
    {
        return $this->type;
    }
//endregion Getters/Setters
}