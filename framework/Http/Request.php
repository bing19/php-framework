<?php

namespace Core\Framework\Http;

class Request
{
    public function __construct(
        private readonly array $getParams,
        private readonly array $postData,
        private readonly array $cookies,
        private readonly array $files,
        private readonly array $server
    ){

    }

    public static function createFromGlobals(): static {
        return new static($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    public function getPostData(): array {
        return $this->postData;
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getUri(): string
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }
}
