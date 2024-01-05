<?php

namespace Core\Framework\Routing;

class Route
{
    public static function get(string $uri, callable|array $handler): array {
        return ['GET', $uri, $handler];
    }

    public static function post(string $uri, array $handler): array {
        return ['POST', $uri, $handler];
    }
}