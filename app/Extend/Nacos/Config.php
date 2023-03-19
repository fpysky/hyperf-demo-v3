<?php

declare(strict_types=1);

namespace App\Extend\Nacos;

use App\Extend\Nacos\Exception\ConfigNotFoundException;

class Config
{
    private string $username;

    private string $password;

    private string $ip;

    private int $port;

    private string $uri;

    private string $namespaceId;

    private string $groupName;

    private float $defaultWeight = 1.0;

    private bool $ephemeral;

    public function __construct(array $config = [])
    {
        if (
            ! isset($config['username'])
            || ! isset($config['password'])
            || ! isset($config['ip'])
            || ! isset($config['port'])
            || ! isset($config['uri'])
        ) {
            throw new ConfigNotFoundException('nacos 配置缺失.');
        }

        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->ip = $config['ip'];
        $this->port = $config['port'];
        $this->uri = $config['uri'];
        $this->namespaceId = $config['namespaceId'] ?? 'public';
        $this->groupName = $config['group_name'] ?? 'DEFAULT_GROUP';
        $this->ephemeral = $config['ephemeral'] ?? true;
    }

    public function getGroupName(): string
    {
        return $this->groupName;
    }

    public function isEphemeral(): bool
    {
        return $this->ephemeral;
    }

    public function getDefaultWeight(): float
    {
        return $this->defaultWeight;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getNamespaceId(): string
    {
        return $this->namespaceId;
    }
}
