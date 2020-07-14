<?php

namespace App\Http\Controllers;

use App\Exceptions\RepositoryNotFoundException;
use App\Services\RepositoryService;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    private $repositoryService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RepositoryService $repositoryService)
    {
        $this->repositoryService = $repositoryService;
    }

    public function compare(Request $request)
    {
        $data = $request->all();
        $compare = $this->repositoryService->compareRepositories(
            $data['owner1'],
            $data['repo1'],
            $data['owner2'],
            $data['repo2']
        );
        return $compare;
    }
}
