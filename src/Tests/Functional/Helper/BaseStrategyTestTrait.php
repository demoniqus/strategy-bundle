<?php

namespace Demoniqus\StrategyBundle\Tests\Functional\Helper;

use PHPUnit\Framework\Assert;

trait BaseStrategyTestTrait
{
//region SECTION: Private
    protected function assertGet(int $id): array
    {
        $find = $this->get($id);
        $this->testResponseStatusOK();

        $this->checkResult($find);

        return $find;
    }

    protected function createStrategy(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function createConstraintBlankName(): array
    {
        $query = static::getDefault(['name' => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankType(): array
    {
        $query = static::getDefault(['type' => '']);

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey('data', $entity);
        Assert::assertArrayHasKey('id', $entity['data']);
        Assert::assertArrayHasKey('name', $entity['data']);
        Assert::assertArrayHasKey('active', $entity['data']);
    }
//endregion Private
}