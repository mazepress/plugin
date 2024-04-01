# MazePress - Plugin
A package library for creating custom plugins.

[![Code Analysis](https://github.com/mazepress/plugin/actions/workflows/analyse.yml/badge.svg)](https://github.com/mazepress/plugin/actions/workflows/analyse.yml)

## Installation
The simplest way to get up and running with this package is using [Composer](http://getcomposer.org/).
In your `composer.json` file:

1. Add this repository url to the `repositories` section as `vcs` type
2. Add `installer-paths` for this repository
3. Run `Composer install mazepress/plugin`

```json
{
  "minimum-stability": "stable",
  "prefer-stable": true,
  "repositories": [
    {
      "type": "composer",
      "url": "https://mazepress.github.io/packagist"
    }
  ],
  "require": {
    "mazepress/plugin": "^1.0"
  },
  "extra": {
    "installer-paths": {
      "packages/{$name}": [
        "mazepress/plugin"
      ]
    }
  }
}
```
Finally, you can simply run the following command for updating the composer:

```sh
$ composer update
```

## Development
Following are the minimum requirements for the development and package dependency management.

- [PHP](https://php.net) version: 7.4 or higher
- [Composer](https://getcomposer.org/) version: 2.0 or higher
- [Node](https://nodejs.org) version: 18.0 or higher

### Environment
Clone or fork the repository and install the dependencies by running the following commands.

Install the [Composer](https://getcomposer.org/) dependency packages.
```shell
composer install
```

### CLI Commands
Following are the available CLI commands tailored with this app development.

Check code quality for PHP files based on [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/).
```shell
composer run phpcs
```

Check PHP codebase for any obvious or tricky bugs and errors with [PHPStan](https://phpstan.org).
```shell
composer run phpstan
```

Run unit testing against all the PHP codebase with [PHPUnit](https://phpunit.de).
```shell
composer run phpunit
```

## Changelog
All the notable changes to this project will be documented in [CHANGELOG.md](CHANGELOG.md) file.

## License
This project is licensed under the MIT License. See [LICENSE](LICENSE.md) for more information.
