<?php

namespace App\Services;

use App\Clients\GithubClient;
use App\RepositoryDetails;

class GithubRepositoryDetailsProvider implements RepositoryDetailsProviderInterface
{
    private $githubClient;

    public function __construct(GithubClient $githubClient)
    {
        $this->githubClient = $githubClient;
    }

    /**
     * @param string $owner
     * @param string $repo
     * @return RepositoryDetails
     */
    public function provide(string $owner, string $repo): RepositoryDetails
    {
        $basicDetails = $this->githubClient->getBasicDetails($owner, $repo);
        $latestReleaseDetails = $this->githubClient->getLatestReleaseDate($owner, $repo);
        $openPullRequests = $this->githubClient->getOpenPullRequests($owner, $repo);
        $closedPullRequests = $this->githubClient->getClosedPullRequests($owner, $repo);

        return new RepositoryDetails(
            $basicDetails['forks_count'],
            $basicDetails['stargazers_count'],
            $basicDetails['watchers_count'],
            $latestReleaseDetails,
            $openPullRequests['total_count'],
            $closedPullRequests['total_count']
        );
    }
}