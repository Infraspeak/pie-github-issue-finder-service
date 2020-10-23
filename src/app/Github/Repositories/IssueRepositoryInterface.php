<?php

namespace App\Github\Repositories;

interface IssueRepositoryInterface
{
    public function getOpenIssues(string $vendorName, string $packageName): array;
}
