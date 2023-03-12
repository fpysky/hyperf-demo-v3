<?php

declare(strict_types=1);

if (! function_exists('jsonPrettyPrint')) {
    function jsonPrettyPrint($contents): void
    {
        if (is_string($contents)) {
            $contents = json_decode($contents);
        }
        echo json_encode($contents, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE) . "\n";
    }
}
