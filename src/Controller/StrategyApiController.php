<?php


use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Demoniqus\StrategyBundle\Dto\StrategyApiDtoInterface;
use Demoniqus\StrategyBundle\Exception\StrategyCannotBeSavedException;
use Demoniqus\StrategyBundle\Exception\StrategyInvalidException;
use Demoniqus\StrategyBundle\Exception\StrategyNotFoundException;
use Demoniqus\StrategyBundle\Manager\CommandManagerInterface;
use Demoniqus\StrategyBundle\Manager\QueryManagerInterface;
use Evrinoma\UtilsBundle\Controller\AbstractApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use Evrinoma\UtilsBundle\Rest\RestInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class StrategyApiController extends AbstractApiController implements ApiControllerInterface
{
    private string $dtoClass;
    /**
     * @var ?Request
     */
    private ?Request $request;
    /**
     * @var QueryManagerInterface|RestInterface
     */
    private QueryManagerInterface $queryManager;
    /**
     * @var CommandManagerInterface|RestInterface
     */
    private CommandManagerInterface $commandManager;
    /**
     * @var FactoryDtoInterface
     */
    private FactoryDtoInterface $factoryDto;

    public function __construct(
        SerializerInterface     $serializer,
        RequestStack            $requestStack,
        FactoryDtoInterface     $factoryDto,
        CommandManagerInterface $commandManager,
        QueryManagerInterface   $queryManager,
        string                  $dtoClass
    ) {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->commandManager = $commandManager;
        $this->queryManager = $queryManager;
        $this->dtoClass = $dtoClass;
    }

    /**
     * @Rest\Post("/api/strategy/create", options={"expose"=true}, name="api_strategy_create")
     * @OA\Post(
     *     tags={"strategy"},
     *     description="the method perform create strategy",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *               example={
     *                  "class": "Demoniqus\StrategyBundle\Dto\StrategyApiDto",
     *                  "type":"sumCalculationStrategy",
     *                  "name":"Demoniqus\StrategyBundle\Example\SumCalculationStrategy"
     *                  },
     *               type="object",
     *               @OA\Property(property="class",type="string",default="Demoniqus\StrategyBundle\Dto\StrategyApiDto"),
     *               @OA\Property(property="id",type="string"),
     *               @OA\Property(property="name",type="string"),
     *               @OA\Property(property="type",type="string"),
     *            )
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Create strategy")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var StrategyApiDtoInterface $strategyApiDto */
        $strategyApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        $this->commandManager->setRestCreated();
        try {
            $json = [];
            $em = $this->getDoctrine()->getManager();

            $em->transactional(
                function () use ($strategyApiDto, $commandManager, &$json) {
                    $json = $commandManager->post($strategyApiDto);
                }
            );
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->setSerializeGroup('api_post_strategy')->json(['message' => 'Create strategy', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Put("/api/strategy/save", options={"expose"=true}, name="api_strategy_save")
     * @OA\Put(
     *     tags={"strategy"},
     *     description="the method perform save strategy for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *               example={
     *                  "class":"Demoniqus\StrategyBundle\Dto\StrategyApiDto",
     *                  "id":"1",
     *                  "active": "a",
     *                  "name":"Demoniqus\StrategyBundle\Example\SumCalculationStrategy",
     *                  "type":"sumCalculationStrategy",
     *                  },
     *               type="object",
     *               @OA\Property(property="class",type="string",default="Demoniqus\StrategyBundle\Dto\StrategyApiDto"),
     *               @OA\Property(property="name",type="string"),
     *               @OA\Property(property="type",type="string"),
     *               @OA\Property(property="active",type="string")
     *            )
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Save code")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var StrategyApiDtoInterface $strategyApiDto */
        $strategyApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        try {
            if ($strategyApiDto->hasId()) {
                $json = [];
                $em = $this->getDoctrine()->getManager();

                $em->transactional(
                    function () use ($strategyApiDto, $commandManager, &$json) {
                        $json = $commandManager->put($strategyApiDto);
                    }
                );
            }
            else {
                throw new StrategyInvalidException('The Dto has\'t ID or class invalid');
            }
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->setSerializeGroup('api_put_strategy')->json(['message' => 'Save strategy', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Delete("/api/strategy/delete", options={"expose"=true}, name="api_strategy_delete")
     * @OA\Delete(
     *     tags={"strategy"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Demoniqus\StrategyBundle\Dto\StrategyApiDto",
     *           readOnly=true
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Delete strategy")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var StrategyApiDtoInterface $strategyApiDto */
        $strategyApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $commandManager = $this->commandManager;
        $this->commandManager->setRestAccepted();

        try {
            if ($strategyApiDto->hasId()) {
                $json = [];
                $em = $this->getDoctrine()->getManager();

                $em->transactional(
                    function () use ($strategyApiDto, $commandManager, &$json) {
                        $commandManager->delete($strategyApiDto);
                        $json = ['OK'];
                    }
                );
            }
            else {
                throw new StrategyInvalidException('The Dto has\'t ID or class invalid');
            }
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->commandManager, $e);
        }

        return $this->json(['message' => 'Delete strategy', 'data' => $json], $this->commandManager->getRestStatus());
    }

    /**
     * @Rest\Get("/api/strategy/criteria", options={"expose"=true}, name="api_strategy_criteria")
     * @OA\Get(
     *     tags={"strategy"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Demoniqus\StrategyBundle\Dto\StrategyApiDto",
     *           readOnly=true
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         @OA\Schema(
     *           type="string",
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="strategy name",
     *         in="query",
     *         name="name",
     *         @OA\Schema(
     *           type="string",
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="strategy type",
     *         in="query",
     *         name="strategy",
     *         @OA\Schema(
     *           type="string",
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Return strategy")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var StrategyApiDtoInterface $strategyApiDto */
        $strategyApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        try {
            $json = $this->queryManager->criteria($strategyApiDto);
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->queryManager, $e);
        }

        return $this->setSerializeGroup('api_get_strategy')->json(['message' => 'Get strategy', 'data' => $json], $this->queryManager->getRestStatus());
    }

    /**
     * @Rest\Get("/api/strategy", options={"expose"=true}, name="api_strategy")
     * @OA\Get(
     *     tags={"strategy"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="Demoniqus\StrategyBundle\Dto\StrategyApiDto",
     *           readOnly=true
     *         )
     *     ),
     *      @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200,description="Return strategy")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var StrategyApiDtoInterface $strategyApiDto */
        $strategyApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        try {
            $json = $this->queryManager->get($strategyApiDto);
        } catch (\Exception $e) {
            $json = $this->setRestStatus($this->queryManager, $e);
        }

        return $this->setSerializeGroup('api_get_strategy')->json(['message' => 'Get strategy', 'data' => $json], $this->queryManager->getRestStatus());
    }

    public function setRestStatus(RestInterface $manager, \Exception $e): array
    {
        switch (true) {
            case $e instanceof StrategyCannotBeSavedException:
                $manager->setRestNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $manager->setRestConflict();
                break;
            case $e instanceof StrategyNotFoundException:
                $manager->setRestNotFound();
                break;
            case $e instanceof StrategyInvalidException:
                $manager->setRestUnprocessableEntity();
                break;
            default:
                $manager->setRestBadRequest();
        }

        return ['errors' => $e->getMessage()];
    }
}