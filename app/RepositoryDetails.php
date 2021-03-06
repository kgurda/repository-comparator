<?php

namespace App;

class RepositoryDetails
{
    private $owner;
    private $repoName;
    private $forksCount;
    private $starsCount;
    private $watchersCount;
    private $openIssuesCount;
    private $latestReleaseDate;
    private $openPullRequestsCount;
    private $closedPullRequestsCount;

    /**
     * RepositoryDetails constructor.
     * @param string $owner
     * @param string $repoName
     * @param int $forksCount
     * @param int $starsCount
     * @param int $watchersCount
     * @param \DateTime|null $latestReleaseDate
     * @param int $openIssuesCount
     * @param int $openPullRequestsCount
     * @param int $closedPullRequestsCount
     */
    public function __construct(string $owner, string $repoName, int $forksCount, int $starsCount, int $watchersCount, ?\DateTime $latestReleaseDate, int $openIssuesCount, int $openPullRequestsCount, int $closedPullRequestsCount)
    {
        $this->owner = $owner;
        $this->repoName = $repoName;
        $this->forksCount = $forksCount;
        $this->starsCount = $starsCount;
        $this->watchersCount = $watchersCount;
        $this->latestReleaseDate = $latestReleaseDate;
        $this->openIssuesCount = $openIssuesCount;
        $this->openPullRequestsCount = $openPullRequestsCount;
        $this->closedPullRequestsCount = $closedPullRequestsCount;
    }

    /**
     * @return string
     */
    public function getOwnerRepoName(): string
    {
        return $this->owner . '/' . $this->repoName;
    }

    public function getByCategory(string $category)
    {
        return $this->{$category};
    }
}
