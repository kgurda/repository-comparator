<?php

use App\RepositoryDetails;

class SimpleRepositoryComparatorTest extends TestCase
{
    /**
     * @return void
     */
    public function testIfCompareMethodReturnsCorrectResults()
    {
        $latestReleaseDate1 =  new DateTime('2020-05-10');
        $repositoryDetails1 = new RepositoryDetails('kgurda', 'repository-1', 10, 15, 2, $latestReleaseDate1, 100, 10, 10);
        $latestReleaseDate2 = new DateTime('2020-05-05');
        $repositoryDetails2 = new RepositoryDetails('kgurda', 'repository-2', 5, 20, 2, $latestReleaseDate2, 10, 11, 2);
        $simpleComparator = new \App\Services\SimpleRepositoryComparator();
        $results = $simpleComparator->compare($repositoryDetails1, $repositoryDetails2);
        foreach ($results['data'] as $datum) {
            switch ($datum['name']) {
                case 'forksCount':
                    $this->assertEquals(10, $datum['repo1']);
                    $this->assertEquals(5, $datum['repo2']);
                    $this->assertEquals('kgurda/repository-1', $datum['winner']);
                    break;
                case 'starsCount':
                    $this->assertEquals(15, $datum['repo1']);
                    $this->assertEquals(20, $datum['repo2']);
                    $this->assertEquals('kgurda/repository-2', $datum['winner']);
                    break;
                case 'watchersCount':
                    $this->assertEquals(2, $datum['repo1']);
                    $this->assertEquals(2, $datum['repo2']);
                    $this->assertEquals('draw', $datum['winner']);
                    break;
                case 'latestReleaseDate':
                    $this->assertEquals('2020-05-10 00:00:00.000000', $datum['repo1']->date);
                    $this->assertEquals('2020-05-05 00:00:00.000000', $datum['repo2']->date);
                    $this->assertEquals('kgurda/repository-1', $datum['winner']);
                    break;
                case 'openIssuesCount':
                    $this->assertEquals(100, $datum['repo1']);
                    $this->assertEquals(10, $datum['repo2']);
                    $this->assertEquals('kgurda/repository-2', $datum['winner']);
                    break;
                case 'openPullRequestsCount':
                    $this->assertEquals(10, $datum['repo1']);
                    $this->assertEquals(11, $datum['repo2']);
                    $this->assertEquals('kgurda/repository-2', $datum['winner']);
                    break;
                case 'closedPullRequestsCount':
                    $this->assertEquals(10, $datum['repo1']);
                    $this->assertEquals(2, $datum['repo2']);
                    $this->assertEquals('kgurda/repository-1', $datum['winner']);
                    break;
            }
        }
    }
}
