<?php

namespace App\Http\Controllers;

use App\Services\RepositoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return JsonResponse
     */
    public function compare(Request $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->repositoryService->compareRepositories(
            $data['owner1'],
            $data['repo1'],
            $data['owner2'],
            $data['repo2']
        );
        return response()->json($result, 200);
    }
}
