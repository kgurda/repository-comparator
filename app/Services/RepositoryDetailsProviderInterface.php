<?php

namespace App\Services;

use App\RepositoryDetails;

interface RepositoryDetailsProviderInterface
{
    public function provide(string $owner, string $repo): RepositoryDetails;
}