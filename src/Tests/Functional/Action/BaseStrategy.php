<?php

namespace Demoniqus\StrategyBundle\Tests\Functional\Action;


use Demoniqus\StrategyBundle\Dto\StrategyApiDto;
use Demoniqus\StrategyBundle\Fixtures\Strategies\BudgetCalcByStageStrategy;
use Demoniqus\StrategyBundle\Fixtures\Strategies\DashedEstimateGenNumberStrategy;
use Demoniqus\StrategyBundle\Tests\Functional\Helper\BaseStrategyTestTrait;
use Demoniqus\StrategyBundle\DemoniqusStrategyBundle;
use Demoniqus\StrategyBundle\Fixtures\Strategies\SlashedEstimateGenNumberStrategy;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\UtilsBundle\Model\ActiveModel;
use PHPUnit\Framework\Assert;


class BaseStrategy extends AbstractServiceTest implements BaseStrategyTestInterface
{
    use BaseStrategyTestTrait;

//region SECTION: Fields
    private const API_PREFIX = DemoniqusStrategyBundle::VENDOR_PREFIX . '/api/' . DemoniqusStrategyBundle::STRATEGY_BUNDLE;
    public const API_GET      = self::API_PREFIX;
    public const API_CRITERIA = self::API_PREFIX . '/criteria';
    public const API_DELETE   = self::API_PREFIX . '/delete';
    public const API_PUT      = self::API_PREFIX . '/save';
    public const API_POST     = self::API_PREFIX . '/create';
//endregion Fields

//region SECTION: Public
    /**
     * @return array
     */
    public static function defaultData(): array
    {
        return [
            "name"  => SlashedEstimateGenNumberStrategy::class,
            "type" => SlashedEstimateGenNumberStrategy::getType(),
        ];
    }

    public function actionPost(): void
    {
        $this->createStrategy();
        $this->testResponseStatusCreated();
    }

    public function actionCriteria(): void
    {
        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "a", "id" => 1]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "a"]);
        $this->testResponseStatusOK();
        Assert::assertCount(5, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "a", "type" => DashedEstimateGenNumberStrategy::getType()]);
        $this->testResponseStatusOK();
        Assert::assertCount(3, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => 3, "active" => "a", "name" => DashedEstimateGenNumberStrategy::class]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find['data']);

        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "a", "name" => SlashedEstimateGenNumberStrategy::class]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find['data']);
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria(["class" => static::getDtoClass(), "active" => "e"]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => 1000]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);

        $find = $this->criteria(["class" => static::getDtoClass(), "name" => strrev(DashedEstimateGenNumberStrategy::class)]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);

        $expectName = explode('\\', DashedEstimateGenNumberStrategy::class);
        $expectName = array_pop($expectName);
        $find = $this->criteria(["class" => static::getDtoClass(), "name" => $expectName]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => 1, "name" => BudgetCalcByStageStrategy::class, "active" => "d"]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => 1, "type" => BudgetCalcByStageStrategy::getType(), "active" => "d"]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);

        $find = $this->criteria(["class" => static::getDtoClass(), "id" => 1, "type" => BudgetCalcByStageStrategy::getType() . BudgetCalcByStageStrategy::getType()]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey('data', $find);
    }

    public function actionPut(): void
    {
        $find = $this->assertGet(1);

        $updated = $this->put(
            static::getDefault(
                [
                    'id' => $find['data']['id'],
                    'type' => DashedEstimateGenNumberStrategy::getType(),
                    'name' => DashedEstimateGenNumberStrategy::class
                ]
            )
        );
        $this->testResponseStatusOK();

        Assert::assertEquals($find['data']['id'], $updated['data']['id']);
        Assert::assertEquals(DashedEstimateGenNumberStrategy::getType(), $updated['data']['type']);
        Assert::assertEquals(DashedEstimateGenNumberStrategy::class, $updated['data']['name']);
    }

    public function actionPutUnprocessable(): void
    {
        $query = static::getDefault(['id' => '']);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $created = $this->createStrategy();
        $this->checkResult($created);

        $query = static::getDefault(['name' => '', 'id' => $created['data']['id']]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault(['type' => '', 'id' => $created['data']['id']]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankName();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankType();
        $this->testResponseStatusUnprocessable();
    }

    public function actionPostDuplicate(): void
    {
        Assert::assertTrue(true);
    }

    public function actionDelete(): void
    {
        $find = $this->assertGet(4);

        Assert::assertContains($find['data']['active'], [ActiveModel::ACTIVE, ActiveModel::BLOCKED]);

        $this->delete(4);
        $this->testResponseStatusAccepted();

        $delete = $this->assertGet(4);

        Assert::assertEquals(ActiveModel::DELETED, $delete['data']['active']);
    }

    public function actionDeleteNotFound(): void
    {
        $response = $this->delete(1000);
        Assert::assertArrayHasKey('data', $response);
        $this->testResponseStatusNotFound();
    }

    public function actionPutNotFound(): void
    {
        $this->put(static::getDefault(["id" => 1000, "type" => DashedEstimateGenNumberStrategy::getType(),]));
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteUnprocessable(): void
    {
        $response = $this->delete('');
        Assert::assertArrayHasKey('data', $response);
        $this->testResponseStatusUnprocessable();
    }

    public function actionGetNotFound(): void
    {
        $response = $this->get(1000);
        Assert::assertArrayHasKey('data', $response);
        $this->testResponseStatusNotFound();
    }

    public function actionGet(): void
    {
        $this->assertGet(2);
    }
//endregion Public

//region SECTION: Getters/Setters
    public static function getDtoClass(): string
    {
        return StrategyApiDto::class;
    }
//endregion Getters/Setters
}