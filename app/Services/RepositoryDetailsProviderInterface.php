<?php

namespace App\Services;

use App\RepositoryDetails;

interface RepositoryDetailsProviderInterface
{
    /**
     * @param string $owner
     * @param string $repo
     * @return RepositoryDetails
     */
    public function provide(string $owner, string $repo): RepositoryDetails;
}