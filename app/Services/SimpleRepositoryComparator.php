<?php

namespace App\Services;

use App\RepositoryDetails;

class SimpleRepositoryComparator implements RepositoryComparatorInterface
{
    const DRAW = 'draw';

    /**
     * @param RepositoryDetails $repositoryDetails1
     * @param RepositoryDetails $repositoryDetails2
     * @return array
     */
    public function compare(RepositoryDetails $repositoryDetails1, RepositoryDetails $repositoryDetails2): array
    {
        $result = [];
        $categories = ['forksCount', 'starsCount', 'watchersCount', 'latestReleaseDate', 'openIssuesCount', 'openPullRequestsCount', 'closedPullRequestsCount'];
        $result['categories'] = $categories;
        foreach ($categories as $key => $category) {
            $result['data'][] = [
                'name' => $category,
                'repo1' => $repositoryDetails1->{$category},
                'repo2' => $repositoryDetails2->{$category},
                'winner' => $this->getWinner($repositoryDetails1, $repositoryDetails2, $category)
            ];
        }
        return $result;
    }

    /**
     * @param RepositoryDetails $repositoryDetails1
     * @param RepositoryDetails $repositoryDetails2
     * @param string $category
     * @return string
     */
    private function getWinner(RepositoryDetails $repositoryDetails1, RepositoryDetails $repositoryDetails2, string $category): string
    {
        switch ($category) {
            case 'openIssuesCount':
                if ($repositoryDetails1->{$category} < $repositoryDetails2->{$category}) {
                    return $repositoryDetails1->getOwnerRepoName();
                } elseif ($repositoryDetails1->{$category} > $repositoryDetails2->{$category}) {
                    return $repositoryDetails2->getOwnerRepoName();
                } else {
                    return self::DRAW;
                }
            default:
            if ($repositoryDetails1->{$category} > $repositoryDetails2->{$category}) {
                return $repositoryDetails1->getOwnerRepoName();
            } elseif ($repositoryDetails1->{$category} < $repositoryDetails2->{$category}) {
                return $repositoryDetails2->getOwnerRepoName();
            } else {
                return self::DRAW;
            }
        }
    }
}