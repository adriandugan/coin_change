# coin_change

ShopKeep technical test

Find the fewest coins for the amount of change needed.

**Requires PHP 7.0 or higher**

## Notes

A single currency (Sterling) is assumed. An infinite number of each coin denomination is available.

I've converted coins into pence to avoid floating point issues by always handling integers.

`calculate()`

Deducts the same coin denomintation until it cannot be used.

I find this code easier to read than using recursion.

## Usage

Run `composer update` then

`php calculate_change_in_fewest_coins.php`

Calculate fewest coins for £5.55 change:

`php calculate_change_in_fewest_coins.php 555`

## Tests

Run `vendor/bin/phpunit`

### Code Coverage

Run `php -dzend_extension=xdebug.so vendor/bin/phpunit --coverage-text  # you need to have xdebug installed`

**100%** - that's because I exercised TDD :)

![image](https://user-images.githubusercontent.com/1913223/32110375-4e09e300-bb2f-11e7-9fc7-33db6d87ae39.png)

## Made With...

* TDD
* VIm
* composer
* PHP 7.0
* PHPCS@PSR2 - code sniffer `vendor/bin/phpcs --standard=PSR2 src/ tests/ calculate_change_in_fewest_coins.php`
* PHPloc - lines of code analytics `vendor/bin/phploc src/`
