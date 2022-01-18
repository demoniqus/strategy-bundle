# Configuration

Переопределение штатного класса сущности

    strategy:
        db_driver: orm модель данных
        factory: App\Strategy\Factory\StrategyFactory фабрика для создания объектов,
                 недостающие значения можно разрешить на уровне Mediator или переопределив фабрику
        entity: App\Strategy\Entity\Strategy сущность
        dto_class: App\Strategy\Dto\StrategyDto класс dto, с которым работает сущность

# CQRS model

Actions в контроллере разбиты на две группы
создание, редактирование, удаление данных

        1. putAction(PUT), postAction(POST), deleteAction(DELETE)
Получение данных

        2. getAction(GET), criteriaAction(GET)

Каждый метод работает со своим менеджером

        1. CommandManagerInterface
        2. QueryManagerInterface

При переопределении штатного класса сущности дополнение данными осуществляется декорированием, с помощью MediatorInterface


Группы сериализации

    1. api_get_strategy - получение стратегии
    2. api_post_strategy - создание стратегии
    3. api_put_strategy -  редактирование стратегии

# Статусы:

    создание:
        стратегия создана HTTP_CREATED 201
    обновление:
        стратегия обновлена HTTP_OK 200
    удаление:
        стратегия удалена HTTP_ACCEPTED 202
    получение:
        стратегия(-ии) найдены HTTP_OK 200
    ошибки:
        если стретагия не найдена, StrategyNotFoundException возвращает HTTP_NOT_FOUND 404
        если стратегия не прошла валидацию, StrategyInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если стратегия не может быть сохранена, StrategyCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400

# Тесты:

    composer install --dev
### run all tests
    /usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap src/Tests/bootstrap.php --configuration phpunit.xml.dist src/Tests --teamcity

### run personal test for example testPost
    /usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap src/Tests/bootstrap.php --configuration phpunit.xml.dist src/Tests/Functional/Controller/TypeApiControllerTest.php --filter "/::testPost( .*)?$/" 

