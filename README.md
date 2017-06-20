[![Latest Stable Version](https://poser.pugx.org/unisharp/doc-us/v/stable)](https://packagist.org/packages/unisharp/doc-us) [![Total Downloads](https://poser.pugx.org/unisharp/doc-us/downloads)](https://packagist.org/packages/unisharp/doc-us) [![License](https://poser.pugx.org/unisharp/doc-us/license)](https://packagist.org/packages/unisharp/doc-us)

# Doc Us

A MySQL Schema Documantation Generator for Laravel.

## Installation

1. Require this package with composer:

```bash
composer require unisharp/doc-us
```

2. After updating composer, add the ServiceProvider to the providers array in `config/app.php`:

```php
'providers' => [
    /* ... */

    UniSharp\DocUs\DocUsServiceProvider::class,

    /* ... */
];
```

## Usage

<http://{host}/schema?format={supported-format}&pretty={option}>

Supported Formats

 - html
 - markdown
 - json (option)

Option (json format only)
 - true
 - false

## Demo

![html](http://i.imgur.com/EQaDRXMg.png)
![markdown](http://i.imgur.com/21P0cR2g.png)
![json](http://i.imgur.com/91VdFr0g.png)

## Test

```
./vendor/bin/phpunit tests
```

## License

The DocUs released under [MIT license](https://unisharp.mit-license.org/).
