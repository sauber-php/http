<?php

declare(strict_types=1);

use JustSteveKing\StatusCode\Http;
use Laminas\Diactoros\ServerRequestFactory;
use Sauber\Http\Router;
use Sauber\Http\Tests\Fixtures\Container;

it('can dispatch closures', function () {
    $router = new Router(
        container: new Container(),
    );

    $router->get(
        path: '/',
        handler: fn () => ['foo' => 'bar'],
    );

    $response = $router->handle(
        request: (new ServerRequestFactory())->createServerRequest(
            method: 'GET',
            uri: '/',
        ),
    );

    expect(
        $response->getBody(),
    )->toEqual(
        json_encode([
            'foo' => 'bar'
        ])
    )->and(
        $response->getStatusCode()
    )->toEqual(Http::OK);
});

it('handles exceptions', function () {
    $router = new Router(
        container: new Container(),
    );

    $router->post(
        path: '/',
        handler: fn() => throw new InvalidArgumentException(message: 'test'),
    );

    $response = $router->handle(
        request: (new ServerRequestFactory())->createServerRequest(
            method: 'POST',
            uri: '/',
        )
    );

    expect(
        $response->getStatusCode(),
    )->toEqual(Http::INTERNAL_SERVER_ERROR);
});