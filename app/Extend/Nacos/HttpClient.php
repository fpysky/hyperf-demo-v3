<?php

declare(strict_types=1);

namespace App\Extend\Nacos;

use App\Extend\Nacos\Exception\NacosException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class HttpClient
{
    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function put(string $uri, array $data = [], array $options = []): Response
    {
        if (! empty($data)) {
            $options[RequestOptions::JSON] = $data;
        }

        return $this->request('PUT', $uri, $options);
    }

    public function patch(string $uri, array $data, array $options = []): Response
    {
        if (! empty($data)) {
            $options[RequestOptions::JSON] = $data;
        }

        return $this->request('PATCH', $uri, $options);
    }

    public function delete(string $uri, array $query = [], array $options = []): Response
    {
        if (! empty($query)) {
            $options[RequestOptions::QUERY] = $query;
        }

        return $this->request('DELETE', $uri, $options);
    }

    public function post(string $uri, array $data = [], array $options = []): Response
    {
        if (! empty($data)) {
            $options[RequestOptions::JSON] = $data;
        }

        return $this->request('POST', $uri, $options);
    }

    public function get(string $uri, array $query = [], array $options = []): Response
    {
        if (! empty($query)) {
            $options[RequestOptions::QUERY] = $query;
        }

        return $this->request('GET', $uri, $options);
    }

    public function request(string $method, string $uri, array $options = []): Response
    {
        try {
            $response = $this->getClient()->request($method, $uri, $options);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        } catch (GuzzleException $e) {
            throw new NacosException("请求失败:{$e->getMessage()}");
        }

        $contents = $response->getBody()->getContents();
        $statusCode = $response->getStatusCode();

        return new Response($contents, $statusCode);
    }

    protected function getClient(): Client
    {
        if (empty($this->config->getUri())) {
            $baseUri = "http://{$this->config->getIp()}:{$this->config->getPort()}";
        } else {
            $baseUri = $this->config->getUri();
        }

        $configs = [
            'base_uri' => $baseUri,
            'timeout' => 3.0,
        ];

        return new Client($configs);
    }
}
