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

![html](/uploads/upload_5c164aad2c6e98ac77d2307abb05f228.png)
![markdown](/uploads/upload_60193479e7811a5e6a233a077ad8ead4.png)
![json](/uploads/upload_c2af66704d856a1a4e2aae6ea50073ba.png)

## Test

```
./vendor/bin/phpunit tests
```

## License

The DocUs released under [MIT license](https://github.com/UniSharp/doc-us/blob/master/LICENSE.md).
