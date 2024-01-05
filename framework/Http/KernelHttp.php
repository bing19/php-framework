<?php

namespace Core\Framework\Http;

use Core\Framework\Http\Exceptions\HttpException;
use Core\Framework\Http\Exceptions\MethodNotAllovedException;
use Core\Framework\Http\Exceptions\RouteNotFoundException;
use Core\Framework\Http\Request;
use Core\Framework\Http\Response;
use Core\Framework\Routing\RouterInterface;

class KernelHttp
{
    public function __construct(
        private RouterInterface $router
    ){}
    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request);
            $response = call_user_func_array($routeHandler, $vars);
        } catch (HttpException $e) {
            $response = new Response($e->getMessage(), $e->getStatusCode());
        } catch (\Throwable $e) {
            return new Response($e->getMessage(), statusCode: 500);
        }
        return $response;
    }
}