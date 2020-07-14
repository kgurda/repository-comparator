<?php

namespace App;

class RepositoryDetails
{
    private $forksCount;
    private $starsCount;
    private $watchersCount;
    private $latestReleaseDate;
    private $openPullRequestsCount;
    private $closedPullRequestsCount;

    /**
     * RepositoryDetails constructor.
     * @param int $forksCount
     * @param int $starsCount
     * @param int $watchersCount
     * @param \DateTime $latestReleaseDate
     * @param int $openPullRequestsCount
     * @param int $closedPullRequestsCount
     */
    public function __construct(int $forksCount, int $starsCount, int $watchersCount, ?\DateTime $latestReleaseDate, int $openPullRequestsCount, int $closedPullRequestsCount)
    {
        $this->forksCount = $forksCount;
        $this->starsCount = $starsCount;
        $this->watchersCount = $watchersCount;
        $this->latestReleaseDate = $latestReleaseDate;
        $this->openPullRequestsCount = $openPullRequestsCount;
        $this->closedPullRequestsCount = $closedPullRequestsCount;
    }
}
