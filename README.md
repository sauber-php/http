<a href="https://supportukrainenow.org/"><img src="https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/banner-direct.svg" width="100%"></a>

# Http Component

<!-- BADGES_START -->
![GitHub release (latest by date)](https://img.shields.io/github/v/release/sauber-php/http)
![Tests](https://github.com/sauber-php/http/workflows/tests/badge.svg)
![Static Analysis](https://github.com/sauber-php/http/workflows/static/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/sauber-php/http.svg?style=flat-square)](https://packagist.org/packages/phpfox/container)
![GitHub](https://img.shields.io/github/license/sauber-php/http)
<!-- BADGES_END -->

This is the repository for the HTTP Component used in the Sauber PHP Framework.

## Installation

You should not need to install this package, as it comes pre-installed with the Sauber PHP Framework, however
if you want to use this outside of the framework please use composer:

```bash
composer require sauber-php/http
```

## Usage

To use the component, you can instantiate with your own container and add routes:

```php
$router = new Router(
    container: new Container(),
);

$router->middleware(
    middleware: new PSR15Middleware(),
);

$router->get(
    path: '/',
    handler: fn () => ['test' => time()],
);

$router->handle(
    request: Request::capture(),
);
```

## Testing

To run the tests:

```bash
./vendor/bin/pest
```

## Static Analysis

To check the static analysis:

```bash
./vendor/bin/phpstan analyse
```

## Changelog

Please see [the Changelog](CHANGELOG.md) for more information on what has changed recently.
