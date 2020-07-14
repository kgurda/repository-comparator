<?php

namespace App\Services;

class RepositoryService
{
    private $repositoryDetailsProvider;
    private $repositoryComparator;

    public function __construct(RepositoryDetailsProviderInterface $repositoryDetailsProvider, RepositoryComparatorInterface $repositoryComparator)
    {
        $this->repositoryDetailsProvider = $repositoryDetailsProvider;
        $this->repositoryComparator = $repositoryComparator;
    }

    public function compareRepositories(string $owner1, string $repo1, string $owner2, string $repo2)
    {
        $firstRepositoryDetails = $this->repositoryDetailsProvider->provide($owner1, $repo1);
        $secondRepositoryDetails = $this->repositoryDetailsProvider->provide($owner2, $repo2);

        return $this->repositoryComparator->compare($firstRepositoryDetails, $secondRepositoryDetails);
    }

}