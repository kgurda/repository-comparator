<?php

namespace App\Http\Controllers;

use App\Services\RepositoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RepositoryController extends Controller
{
    private $repositoryService;

    /**
     * RepositoryController constructor.
     * @param RepositoryService $repositoryService
     */
    public function __construct(RepositoryService $repositoryService)
    {
        $this->repositoryService = $repositoryService;
    }

    /**
     *  @OA\Get(
     *      path="/repositories/comparison",
     *      tags={"Repository controller"},
     *      summary="Get repositories statistics",
     *      description="Returns list of projects",
     *      @OA\Parameter(
     *          name="owner1",
     *          description="Owner of the first repository",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          style="form"
     *      ),
     *      @OA\Parameter(
     *          name="repo1",
     *          description="Name of the first repository",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          style="form"
     *      ),
     *      @OA\Parameter(
     *          name="owner2",
     *          description="Owner of the second repository",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          style="form"
     *      ),
     *      @OA\Parameter(
     *          name="repow",
     *          description="Name of the second repository",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          style="form"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="Not found"
     *      ),
     *     @OA\Response(
     *          response=503,
     *          description="Service not available"
     *      )
     *     )
     * @param Request $request
     * @return JsonResponse
     */
    public function compare(Request $request): JsonResponse
    {
        $parameters = $request->all();

        if (!isset($parameters['owner1']) || !isset($parameters['repo1']) ||
            !isset($parameters['owner2']) || !isset($parameters['repo2'])) {
            return response()->json([], Response::HTTP_BAD_REQUEST);
        }

        $result = $this->repositoryService->compareRepositories(
            $parameters['owner1'],
            $parameters['repo1'],
            $parameters['owner2'],
            $parameters['repo2']
        );
        return response()->json($result, Response::HTTP_OK);
    }
}
