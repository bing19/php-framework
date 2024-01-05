<?php

namespace Core\Framework\Routing;
use Core\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request): array;
}