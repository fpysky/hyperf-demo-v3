<?php

declare(strict_types=1);

namespace App\Extend\Nacos;

use App\Extend\Nacos\Exception\NacosException;

class Instance extends AbstractProvider
{
    public function register(string $ip, int $port, string $serviceName)
    {
        $data = [
            'ip' => $ip,
            'port' => $port,
            'serviceName' => $serviceName,
            'weight' => $this->config->getDefaultWeight(),
        ];

        $response = $this->getHttpClient()
            ->post('/nacos/v1/ns/instance', array_merge($this->getSendDefaultData(), $data));

        if (! $response->isOk()) {
            throw new NacosException("注册实例异常:{$response->getRawContents()}");
        }
    }

    public function delete(string $ip, int $port, string $serviceName)
    {
        $query = [
            'ip' => $ip,
            'port' => $port,
            'serviceName' => $serviceName,
        ];

        $response = $this->getHttpClient()
            ->delete('/nacos/v1/ns/instance', array_merge($this->getSendDefaultData(), $query));

        if (! $response->isOk()) {
            throw new NacosException("注销实例异常:{$response->getRawContents()}");
        }
    }

    public function update(string $ip, int $port, string $serviceName, float $weight = 1.0)
    {
        $data = [
            'ip' => $ip,
            'port' => $port,
            'serviceName' => $serviceName,
            'weight' => $weight,
        ];

        $response = $this->getHttpClient()
            ->put('/nacos/v1/ns/instance', array_merge($this->getSendDefaultData(),$data));

        if (! $response->isOk()) {
            throw new NacosException("更新实例异常:{$response->getRawContents()}");
        }
    }

    public function list(string $serviceName)
    {
        $query = [
            'serviceName' => $serviceName,
        ];

        $response  = $this->getHttpClient()
            ->get('/nacos/v1/ns/instance/list',array_merge($this->getSendDefaultData(),$query));

        if (! $response->isOk()) {
            throw new NacosException("查询服务[{$serviceName}]的实例列表异常:{$response->getRawContents()}");
        }


    }
}
