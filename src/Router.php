<?php

declare(strict_types = 1);

namespace Sauber\Http;

use Closure;
use League\Route\Route;
use Psr\Container\ContainerInterface;
use Laminas\Diactoros\ResponseFactory;
use League\Route\RouteCollectionTrait;
use League\Route\Strategy\JsonStrategy;
use Psr\Http\Message\ResponseInterface;
use League\Route\Router as LeagueRouter;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use League\Route\Middleware\MiddlewareAwareTrait;
use League\Route\Middleware\MiddlewareAwareInterface;

final class Router implements RequestHandlerInterface, MiddlewareAwareInterface
{
    use RouteCollectionTrait;
    use MiddlewareAwareTrait;

    private readonly LeagueRouter $baseRouter;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $responseStrategy = new JsonStrategy(
            responseFactory: new ResponseFactory(),
        );

        $responseStrategy->setContainer(
            container: $container,
        );

        $this->baseRouter = new LeagueRouter();
        $this->baseRouter->setStrategy(
            strategy: $responseStrategy,
        );
    }

    /**
     * @param string $method
     * @param string $path
     * @param Closure|string $handler
     * @return Route
     */
    public function map(string $method, string $path, mixed $handler): Route
    {
        return $this->baseRouter->map(
            method: $method,
            path: $path,
            handler: $handler,
        );
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->baseRouter->dispatch(
            request: $request,
        );
    }
}
