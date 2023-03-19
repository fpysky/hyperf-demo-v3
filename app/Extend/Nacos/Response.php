<?php

declare(strict_types=1);

namespace App\Extend\Nacos;

class Response
{
    private int $statusCode;

    private string $rawContents;

    public function __construct(string $rawContents, int $statusCode)
    {
        $this->statusCode = $statusCode;
        $this->rawContents = $rawContents;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getRawContents(): string
    {
        return $this->rawContents;
    }

    public function isOk(): bool
    {
        return $this->statusCode === 200;
    }
}
