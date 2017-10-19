# coin_change

ShopKeep technical test

Find the fewest coins for the amount of change needed.

**Requires PHP 7.0 or higher**

## Notes

A single currency (Sterling) is assumed. An infinite number of each coin denomination is available.

I've converted coins into pence to avoid floating point issues by always handling integers.

### Solution One

`calculate()`

Deducts the same coin denomintation until it cannot be used.

### Solution Two

`calculateUsingRecursion()`

Uses recursion to call the same deduct method. I figured this - dynamic programming - is what the challenge was looking for, but it's probably not the solution I'd use in production code. (I don't like solutions which are too smart or magical and recursion is heading in that direction.)

## Usage

Run `composer update` then

`php calculate_change_in_fewest_coins.php`

Calculate fewest coins for £5.55 change:

`php calculate_change_in_fewest_coins.php 555`

## Tests

Run `vendor/bin/phpunit`

## Made With...

* TDD
* VIm
* composer
* PHP 7.0
* PHPCS@PSR2 - code sniffer `vendor/bin/phpcs --standard=PSR2 src tests calculate_change_in_fewest_coins.php`
