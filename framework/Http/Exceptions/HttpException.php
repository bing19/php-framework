<?php

namespace Core\Framework\Http\Exceptions;
class HttpException extends \Exception 
{
    private int $statusCode = 400;

    public function setStatusCode(int $code): HttpException {
        $this->statusCode = $code;
        return $this;
    }
    public function getStatusCode(): int {
        return $this->statusCode;
    }

}