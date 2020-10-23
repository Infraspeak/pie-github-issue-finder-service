<?php

namespace App\Github\Repositories;

use App\Github\Schema\Issue;
use App\Github\Schema\Repo;

interface IssueRepositoryInterface
{
    /** @return array<Issue> */
    public function getOpenIssues(Repo $repo): array;
}
