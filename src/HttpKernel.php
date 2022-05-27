<?php

declare(strict_types = 1);

namespace Sauber\Http;

use Throwable;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;

final class HttpKernel
{
    /**
     * @param RequestHandlerInterface $requestHandler
     */
    public function __construct(
        private readonly RequestHandlerInterface $requestHandler,
    ) {
    }

    /**
     * @param RequestHandlerInterface $requestHandler
     * @return HttpKernel
     */
    public static function using(RequestHandlerInterface $requestHandler): self
    {
        return new self(
            requestHandler: $requestHandler,
        );
    }

    /**
     * @param ServerRequestInterface $request
     * @return void
     */
    public function dispatch(ServerRequestInterface $request): void
    {
        $runner = new RequestHandlerRunner(
            handler: $this->requestHandler,
            emitter: new SapiEmitter(),
            serverRequestFactory: fn () => $request,
            serverRequestErrorResponseGenerator: fn (Throwable $exception) => throw $exception,
        );

        $runner->run();
    }
}
