<?php

// Force typehinting into strict mode
declare(strict_types = 1);

/**
 * A simple CLI interface to the ChangeCalculator.
 *
 * USAGE: php calculate_change_in_fewest_coins.php {integer_value_in_pence}
 *   e.g. php calculate_change_in_fewest_coins.php 49
 *
 * @author Duggie <wave@dugg.ie>
 * @since 2017-10-19
 */

require_once(__DIR__ . '/vendor/autoload.php');

use App\ChangeCalculator;

/** @var int $change_amount pass the change amount in as command line parameter */
$change_amount = null;
if (isset($argv[1]) && is_numeric($argv[1])) {
    $change_amount = (int) $argv[1];
}

if (is_null($change_amount)) {
    die("\nusage: php $argv[0] {integer_value_in_pence}" . PHP_EOL);
}

try {
    $calc = new ChangeCalculator($change_amount);
} catch (TypeError $e) {
    die('You cannot get change for: ' . json_encode($change_amount) . PHP_EOL);
} catch (\Exception $e) {
    die('You cannot get change for: ' . json_encode($change_amount) . PHP_EOL);
}

$coins = $calc->calculate();

printf(
    "\nYour change is £%0.2f.\n\nIn fewest coins, that would be a total of *%d* coins:\n\n  =>  %s  <=\n\n",
    ($change_amount / 100), // convert into pounds & pence
    count($coins),
    $coins ? implode(', ', $coins) : 'none'
);
