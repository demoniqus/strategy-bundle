<?php


namespace App\Strategy\Bundle\Dto;


use App\Strategy\Bundle\Model\ModelInterface as BaseModel;
use App\Strategy\Model\ModelInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoCommon\ValueObject\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\IdTrait;
use Evrinoma\DtoCommon\ValueObject\NameTrait;
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
            $id         = $request->get(BaseModel::ID);
            $name       = $request->get(BaseModel::NAME);
            $active     = $request->get(BaseModel::ACTIVE);
            $type     = $request->get(BaseModel::TYPE);


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