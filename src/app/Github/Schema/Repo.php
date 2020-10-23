<?php

namespace App\Github\Schema;

use JsonSerializable;

class Repo implements JsonSerializable
{
    /** @var string */
    private $name;

    /** @var string */
    private $vendorName;

    /** @var string */
    private $repoName;

    /** @var string */
    private $version;

    /** @var string */
    private $url;

    public function __construct(string $name, string $url, string $version)
    {
        if (!preg_match('/github.com\/([\w_-]+)\/([\w_-]+)/', $url, $matches)) {
            throw new \Exception('Invalid github repo');
        }

        $this->name = $name;
        $this->version = $version;
        $this->url = $url;
        $this->vendorName = $matches[1];
        $this->repoName = $matches[2];
    }

    public function getVendorName(): string
    {
        return $this->vendorName;
    }

    public function getGetRepoName(): string
    {
        return $this->repoName;
    }

    public function jsonSerialize(): array
    {
        return [
            "name" => $this->name,
            "version" => $this->version,
            "url" => $this->url,
        ];
    }
}
