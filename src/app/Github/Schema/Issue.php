<?php

namespace App\Github\Schema;

use DateTimeInterface;
use JsonSerializable;

class Issue implements JsonSerializable
{
    /** @var int */
    private $id;

    /** @var string */
    private $url;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $author;

    /** @var string */
    private $status;

    /** @var string */
    private $createdAt;

    /** @var array<string> */
    private $tags;

    /**
     * @param array<string> $tags
     */
    public function __construct(
        int $id,
        string $url,
        string $title,
        string $description,
        string $author,
        string $status,
        DateTimeInterface $createdAt,
        array $tags = []
    ) {

        $this->id = $id;
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->tags = $tags;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "url" => $this->url,
            "title" => $this->title,
            "description" => $this->description,
            "author" => $this->author,
            "status" => $this->status,
            "date_opened" => $this->createdAt->format(DateTimeInterface::ISO8601),
            "tags" => $this->tags,
        ];
    }
}
