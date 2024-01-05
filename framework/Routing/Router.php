<?php

namespace Core\Framework\Routing;

use Core\Framework\Http\Exceptions\MethodNotAllovedException;
use Core\Framework\Http\Exceptions\RouteNotFoundException;
use Core\Framework\Routing\RouterInterface;
use Core\Framework\Http\Request;
use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher as simpleDispatcher;

class Router implements RouterInterface
{
    public function dispatch(Request $request): array {

        [$handler, $params] = $this->extractRouteInfo($request);

        if(is_array($handler)){
            [$controller, $method] = $handler;
            $handler = [new $controller($request), $method];
        }
        
        return [$handler, $params];
    }

    private function extractRouteInfo(Request $request): array {
        $dispatcher = simpleDispatcher(function(RouteCollector $collector) {

            $routes = include BASE_PATH . '/routes/web.php';
            
            foreach ($routes as $route) {
                $collector->addRoute(...$route);
            }
        });

        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getUri());

        switch ($routeInfo[0]) {
            case Dispatcher::FOUND:
                return [
                    $routeInfo[1],
                    $routeInfo[2],
                ];
            case Dispatcher::METHOD_NOT_ALLOWED:
                $supportedMethods = implode(',', $routeInfo[1]);
                $massege = 'Supported HTTP Methods '. $supportedMethods;
                $e = new MethodNotAllovedException(message: $massege);
                $e->setStatusCode(405);
                throw $e;
            default:
                $e = new RouteNotFoundException(message: 'Route not Found');
                $e->setStatusCode(404);
                throw $e;

        }
    }
}