<?php

namespace App;

/**
 * Calculate the fewest coins needed to return the amount of change.
 *
 * Assumptions:
 *   * single currency used (Sterling);
 *   * only real coin denominations are used; and
 *   * an infinite number of coins are available.
 *
 * @author Duggie <wave@dugg.ie>
 * @since  2017-10-19
 */

use Exception;

class ChangeCalculator
{
    /**
     * @var array list of coin denominations in use (given in pence to avoid
     * rounding errors). The descending order of the coins in this list is
     * significant.
     */
    const COINS = [200, 100, 50, 20, 10, 5, 2, 1];

    /**
     * @var int holds the amount of change to return (in pence)
     */
    private $change_amount;

    /**
     * @var array list of coins to return as change
     */
    private $coins_due = [];

    /**
     * Instantiate the model.
     *
     * @param int $change_amount the value of coins to give back
     *
     * @throws Exception
     */
    public function __construct(int $change_amount)
    {
        if ($change_amount < 0) {
            throw new Exception('invalid change value - cannot be negative');
        }

        $this->change_amount = $change_amount;
    }

    /**
     * Calculates the list of coins to return for the change amount.
     *
     * @return array
     */
    public function calculate()
    {
        // Do the math
        $this->performCalculation();

        // List of coins used
        return $this->coins_due;
    }

    /**
     * Iterate through each coin, taking it off the change amount,
     * leaving us with a list of all the coins needed.
     *
     * @return void
     */
    private function performCalculation()
    {
        foreach (self::COINS as $coin) {
            if (! $this->keepDeductingCoinWhileChangeAmountExists($coin)) {
                break;
            }
        }
    }

    /**
     * Check there is a change amount remaining. If there is, deduct the coin
     * as many times as possible.
     * If there is no change amount remaining, we can stop the calculations.
     *
     * @param int $coin
     *
     * @return bool
     */
    private function keepDeductingCoinWhileChangeAmountExists(int $coin)
    {
        if ($this->isCalculationCompleted()) {
            return false;
        }

        return $this->keepDeductingCoin($coin);
    }

    /**
     * Keep deducting the value of the coin from the change until
     * the coin is larger than the remaining change.
     *
     * @param int $coin
     *
     * @return bool
     */
    private function keepDeductingCoin(int $coin)
    {
        while ($coin <= $this->change_amount) {
            $this->deductCoinFromChangeAndStoreUsage($coin);
        }

        return true;
    }

    /**
     * Take the coin value away from the change amount; record the coin usage.
     *
     * @param int $coin
     *
     * @return void
     */
    private function deductCoinFromChangeAndStoreUsage(int $coin)
    {
        $this->reduceChangeAmountByCoin($coin);

        $this->addCoinToChange($coin);
    }

    /**
     * Push the coin onto the end of the list.
     *
     * @param int $coin
     *
     * @return void
     */
    private function addCoinToChange(int $coin)
    {
        $this->coins_due[] = $coin;
    }

    /**
     * Deduct coin from change amount.
     *
     * @param int $coin
     *
     * @return void
     */
    private function reduceChangeAmountByCoin(int $coin)
    {
        $this->change_amount -= $coin;
    }

    /**
     * A simple check against the change amount value to see when it hits zero.
     *
     * @return bool
     */
    private function isCalculationCompleted()
    {
        return ($this->change_amount === 0);
    }
}
