<?php

namespace App\Clients;

use App\Exceptions\RepositoryNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class GithubClient
{
    const GITHUB_URI = 'https://api.github.com';

    private $client;

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

    public function getBasicDetails($owner, $repo): array
    {
        try {
            $response = $this->client->get("/repos/$owner/$repo");
            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            throw new RepositoryNotFoundException("Github repository: $repo not found");
        }
    }

    private function isReleaseExist($owner, $repo): bool
    {
        $response = $this->client->get("/repos/$owner/$repo/releases");
        return !empty(json_decode($response->getBody(), true));
    }

    public function getLatestReleaseDate($owner, $repo): ?\DateTime
    {
        if (self::isReleaseExist($owner, $repo)) {
            $response = $this->client->get("/repos/$owner/$repo/releases/latest");
            $latestRelease = json_decode($response->getBody(), true);
            return \DateTime::createFromFormat(\DateTime::ISO8601, $latestRelease['created_at']);
        }
        return null;
    }

    public function getOpenPullRequests($owner, $repo): array
    {
        $response = $this->client->get("/search/issues?q=+repo:$owner/$repo+state:open+type:pr");
        return json_decode($response->getBody(), true);
    }

    public function getClosedPullRequests($owner, $repo): array
    {
        $response = $this->client->get("/search/issues?q=+repo:$owner/$repo+state:closed+type:pr");
        return json_decode($response->getBody(), true);
    }
}
