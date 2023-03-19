<?php

declare(strict_types=1);

namespace App\Extend\Nacos;

abstract class AbstractProvider
{
    protected HttpClient $httpClient;

    protected Config $config;

    public function __construct()
    {
        $this->config = new Config(config('nacos'));
        $this->httpClient = new HttpClient($this->config);
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    protected function getSendDefaultData(): array
    {
        return [
            'namespaceId' => $this->config->getNamespaceId(),
            'groupName' => $this->config->getGroupName(),
            'metadata' => '',
            'ephemeral' => $this->config->isEphemeral(),
        ];
    }
}
