<?php

declare(strict_types=1);

namespace Sauber\Http\Tests\Fixtures;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    public function get(string $id)
    {
        return $id;
    }

    public function has(string $id): bool
    {
        return true;
    }
}
