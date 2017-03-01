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

<http://{host}/schema?format={supported-format}>

## Supported Formats

- HTML
- Markdown
- JSON
