# Contracts Plugin for Pest PHP

This repository contains the Pest Plugin Contracts.

> If you want to start testing your application with Pest, visit the main **[Pest Repository](https://github.com/pestphp/pest)**.

## Installation

```bash
composer require webmaesther/pest-plugin-contracts --dev
```

## Usage

Define your contracts anywhere in your test folder in `*Contract.php` files.

```php
contract('is string', function() {
    
    test('its type is string', function(mixed $value) {
    
        expect($value)->toBeString();
    })
});
```

Then you can use your contracts in any of your test files.

```php

fulfill('is string')->with(['string']);
```

The `fullfill` function simply creates a describe block out of your contract closure, and includes it in your test file, exactly where you put it, as if you yourself would have written it. Thus, you can use any method on it that you would use on a describe block. Most notably you will need the `with()` method, which you should use to parametrize your tests with any Pest compatible dataset you like.
