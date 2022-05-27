<?php

declare(strict_types = 1);

namespace Sauber\Http;

use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface;

final class Request
{
    /**
     * @return ServerRequestInterface
     */
    public static function capture(): ServerRequestInterface
    {
        return ServerRequestFactory::fromGlobals();
    }
}
