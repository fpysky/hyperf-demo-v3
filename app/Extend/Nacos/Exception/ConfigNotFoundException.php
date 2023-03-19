<?php

declare(strict_types=1);

namespace App\Extend\Nacos\Exception;

class ConfigNotFoundException extends NacosException
{
    public function __construct(string $message = '', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
