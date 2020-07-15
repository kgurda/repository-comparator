<?php

namespace App\Clients;

use App\Exceptions\GithubServiceUnavailableException;
use App\Exceptions\RepositoryNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class GithubClient
{
    const GITHUB_URI = 'https://api.github.com';

    private $client;

    /**
     * GithubClient constructor.
     */
    public function __construct()
    {
        $accessToken  = env('CLIENT_SECRET');
        $this->client = new Client([
            'base_uri' => self::GITHUB_URI,
            'headers'  => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);
    }

    /**
     * @param $owner
     * @param $repo
     * @return array
     * @throws GithubServiceUnavailableException
     * @throws RepositoryNotFoundException
     */
    public function getBasicDetails($owner, $repo): array
    {
        try {
            $response = $this->client->get("/repos/$owner/$repo");
            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            if ($e->getCode() == 404) {
                throw new RepositoryNotFoundException("Github repository: $repo not found");
            } else {
                throw new GithubServiceUnavailableException();
            }
        }
    }

    /**
     * @param $owner
     * @param $repo
     * @return bool
     * @throws GithubServiceUnavailableException
     */
    private function isReleaseExist($owner, $repo): bool
    {
        try {
            $response = $this->client->get("/repos/$owner/$repo/releases");
            return !empty(json_decode($response->getBody(), true));
        } catch (ClientException $e) {
            throw new GithubServiceUnavailableException();
        }
    }

    /**
     * @param $owner
     * @param $repo
     * @return \DateTime|null
     * @throws GithubServiceUnavailableException
     */
    public function getLatestReleaseDate($owner, $repo): ?\DateTime
    {
        if (self::isReleaseExist($owner, $repo)) {
            try {
                $response = $this->client->get("/repos/$owner/$repo/releases/latest");
                $latestRelease = json_decode($response->getBody(), true);
                return \DateTime::createFromFormat(\DateTime::ISO8601, $latestRelease['created_at']);
            } catch (ClientException $e) {
                throw new GithubServiceUnavailableException();
            }
        }
        return null;
    }

    /**
     * @param $owner
     * @param $repo
     * @return array
     * @throws GithubServiceUnavailableException
     */
    public function getOpenIssues($owner, $repo): array
    {
        try {
            $response = $this->client->get("/search/issues?q=+repo:$owner/$repo+state:open+type:issue");
            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            throw new GithubServiceUnavailableException();
        }
    }

    /**
     * @param $owner
     * @param $repo
     * @return array
     * @throws GithubServiceUnavailableException
     */
    public function getOpenPullRequests($owner, $repo): array
    {
        try {
            $response = $this->client->get("/search/issues?q=+repo:$owner/$repo+state:open+type:pr");
            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            throw new GithubServiceUnavailableException();
        }
    }

    /**
     * @param $owner
     * @param $repo
     * @return array
     * @throws GithubServiceUnavailableException
     */
    public function getClosedPullRequests($owner, $repo): array
    {
        try {
            $response = $this->client->get("/search/issues?q=+repo:$owner/$repo+state:closed+type:pr");
            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            throw new GithubServiceUnavailableException();
        }
    }
}
