<?php

declare(strict_types=1);

namespace App\Extend\Nacos\Model;

class InstanceList
{
    private string $name;

    private string $groupName;

    private string $clusters;

    private int $cacheMillis;
}
