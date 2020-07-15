<?php

use App\Clients\GithubClient;
use App\Exceptions\GithubServiceUnavailableException;
use App\Exceptions\RepositoryNotFoundException;

class GithubClientTest extends TestCase
{
    /**
     * @return void
     */
    public function testIfBasicDetailsEndpointReturnsForksStarsAndWatchersCount()
    {
        $owner = 'kgurda';
        $repo = 'repository-comparator';
        $client = new GithubClient();
        $response = $client->getBasicDetails($owner, $repo);
        $this->assertEquals('kgurda', $response['owner']['login']);
        $this->assertArrayHasKey('forks_count', $response);
        $this->assertArrayHasKey('stargazers_count', $response);
        $this->assertArrayHasKey('watchers_count', $response);
    }

    /**
     * @return void
     */
    public function testIfBasicDetailsEndpointThrowsExceptionIfRepositoryDoesNotExist()
    {
        $owner = 'kgurda';
        $repo = 'repository-comparatorr';
        $this->expectException(RepositoryNotFoundException::class);
        $client = new GithubClient();
        $client->getBasicDetails($owner, $repo);
    }

    /**
     * @return void
     */
    public function testIfLatestReleaseEndpointReturnsNullReleaseDate()
    {
        $owner = 'kgurda';
        $repo = 'repository-comparator';
        $client = new GithubClient();
        $response = $client->getLatestReleaseDate($owner, $repo);
        $this->assertNull($response);
    }

    /**
     * @return void
     */
    public function testIfLatestReleaseEndpointThrowsExceptionIfRepositoryDoesNotExist()
    {
        $owner = 'kgurda';
        $repo = 'repository-comparatorr';
        $this->expectException(GithubServiceUnavailableException::class);
        $client = new GithubClient();
        $client->getLatestReleaseDate($owner, $repo);
    }

    /**
     * @return void
     */
    public function testIfOpenIssuesEndpointReturnsNumberOfOpenIssues()
    {
        $owner = 'kgurda';
        $repo = 'repository-comparator';
        $client = new GithubClient();
        $response = $client->getOpenIssues($owner, $repo);
        $this->assertEquals(0, $response['total_count']);
    }

    /**
     * @return void
     */
    public function testIfOpenIssuesEndpointEndpointThrowsExceptionIfRepositoryDoesNotExist()
    {
        $owner = 'kgurda';
        $repo = 'repository-comparatorr';
        $this->expectException(GithubServiceUnavailableException::class);
        $client = new GithubClient();
        $client->getOpenIssues($owner, $repo);
    }

    /**
     * @return void
     */
    public function testIfOpenPullRequestsEndpointReturnsNumberOfOpenPullRequest()
    {
        $owner = 'kgurda';
        $repo = 'repository-comparator';
        $client = new GithubClient();
        $response = $client->getOpenPullRequests($owner, $repo);
        $this->assertEquals(0, $response['total_count']);
    }

    /**
     * @return void
     */
    public function testIfOpenPullRequestEndpointEndpointThrowsExceptionIfRepositoryDoesNotExist()
    {
        $owner = 'kgurda';
        $repo = 'repository-comparatorr';
        $this->expectException(GithubServiceUnavailableException::class);
        $client = new GithubClient();
        $client->getOpenPullRequests($owner, $repo);
    }

    /**
     * @return void
     */
    public function testIfClosedPullRequestsEndpointReturnsNumberOfClosedPullRequest()
    {
        $owner = 'kgurda';
        $repo = 'repository-comparator';
        $client = new GithubClient();
        $response = $client->getClosedPullRequests($owner, $repo);
        $this->assertEquals(0, $response['total_count']);
    }

    /**
     * @return void
     */
    public function testIfClosedPullRequestEndpointEndpointThrowsExceptionIfRepositoryDoesNotExist()
    {
        $owner = 'kgurda';
        $repo = 'repository-comparatorr';
        $this->expectException(GithubServiceUnavailableException::class);
        $client = new GithubClient();
        $client->getOpenPullRequests($owner, $repo);
    }
}
