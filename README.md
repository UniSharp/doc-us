[![Latest Stable Version](https://poser.pugx.org/unisharp/doc-us/v/stable)](https://packagist.org/packages/unisharp/doc-us)
[![Total Downloads](https://poser.pugx.org/unisharp/doc-us/downloads)](https://packagist.org/packages/unisharp/doc-us)
[![License](https://poser.pugx.org/unisharp/doc-us/license)](https://packagist.org/packages/unisharp/doc-us)

# Doc Us

A MySQL Schema Documentation Generator for Laravel.

## Installation

1. Require this package with composer:

```bash
composer require unisharp/doc-us
```

2. Add `ENABLE_DOC_US` in `.env` (Default is disable)

```
ENABLE_DOC_US=true
```

3. Add the ServiceProvider to the providers array in `config/app.php`:

> If you are using Laravel 5.5 or newer, you don’t need to do this step.

```php
'providers' => [
    /* ... */

    UniSharp\DocUs\DocUsServiceProvider::class,

    /* ... */
];
```

## Usage

### Output format

<http://{host}/schema?format={supported-format}>

Supported Formats

- html
- markdown
- json

### exclude special table

<http://{host}/schema?exclude={special-table}>

Using comma to separate multiple table.

like

<http://{host}/schema?exclude={table1},{table2}>

## Demo

#### HTML

![html](http://i.imgur.com/EQaDRXMg.png)

#### Markdown

![markdown](http://i.imgur.com/kt92Uflg.png)

#### Json

![json](http://i.imgur.com/VCzAw3Qg.png)

## Test

```
vendor/bin/phpunit tests
```

## License

The DocUs released under [MIT license](https://unisharp.mit-license.org/).
