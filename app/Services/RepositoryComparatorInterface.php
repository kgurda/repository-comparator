<?php

namespace App\Services;

use App\RepositoryDetails;

interface RepositoryComparatorInterface
{
    /**
     * @param RepositoryDetails $repositoryDetails1
     * @param RepositoryDetails $repositoryDetails2
     * @return array
     */
    public function compare(RepositoryDetails $repositoryDetails1, RepositoryDetails $repositoryDetails2): array;
}