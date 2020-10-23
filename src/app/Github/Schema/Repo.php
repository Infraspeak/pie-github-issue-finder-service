<?php

namespace App\Github\Schema;

use JsonSerializable;

class Repo implements JsonSerializable
{
    /** @var string */
    private $vendorName;

    /** @var string */
    private $repoName;

    /** @var string */
    private $version;

    /** @var string */
    private $url;

    public function __construct(string $name, string $version, string $url)
    {
        list($this->vendorName, $this->repoName) = explode('/', $name);
        $this->version = $version;
        $this->url = $url;
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
            "name" => "$this->vendorName/$this->repoName",
            "version" => $this->version,
            "url" => $this->url,
        ];
    }
}
