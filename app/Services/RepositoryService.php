<?php

namespace App\Services;

class RepositoryService
{
    private $repositoryDetailsProvider;
    private $repositoryComparator;

    /**
     * RepositoryService constructor.
     * @param RepositoryDetailsProviderInterface $repositoryDetailsProvider
     * @param RepositoryComparatorInterface $repositoryComparator
     */
    public function __construct(RepositoryDetailsProviderInterface $repositoryDetailsProvider, RepositoryComparatorInterface $repositoryComparator)
    {
        $this->repositoryDetailsProvider = $repositoryDetailsProvider;
        $this->repositoryComparator = $repositoryComparator;
    }

    /**
     * @param string $owner1
     * @param string $repo1
     * @param string $owner2
     * @param string $repo2
     * @return array
     */
    public function compareRepositories(string $owner1, string $repo1, string $owner2, string $repo2): array
    {
        $repositoryDetails1 = $this->repositoryDetailsProvider->provide($owner1, $repo1);
        $repositoryDetails2 = $this->repositoryDetailsProvider->provide($owner2, $repo2);

        return $this->repositoryComparator->compare($repositoryDetails1, $repositoryDetails2);
    }

}