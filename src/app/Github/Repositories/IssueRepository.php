<?php

namespace App\Github\Repositories;

use App\Github\Entities\Issue;
use Github\Client;
use Monolog\DateTimeImmutable;

class IssueRepository implements IssueRepositoryInterface
{
    private const STATE_OPEN = 'open';
    private const RESULTS_PER_PAGE = 100;

    private $client;

    public function __construct(Client $githubClient)
    {
        $this->client = $githubClient;
    }

    public function getOpenIssues(string $vendorName, string $packageName): array {
        $searchParameters = [
            'state' => self::STATE_OPEN,
            'per_page' => self::RESULTS_PER_PAGE,
        ];

        return array_map(
            [$this, 'parseIssue'],
            $this->client->issues()->all($vendorName, $packageName, $searchParameters)
        );
    }

    private function parseIssue(array $issueData): Issue
    {
        return new Issue(
            $issueData['id'],
            $issueData['url'],
            $issueData['title'],
            $issueData['body'],
            $issueData['user']['login'],
            $issueData['state'],
            DateTimeImmutable::createFromFormat(DateTimeImmutable::ISO8601, $issueData['created_at']),
            array_map(static function(array $label): string {
                return $label['name'];
            }, $issueData['labels'])
        );
    }
}
