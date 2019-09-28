<?php
require_once "./Game.php";

/**
 * GAME START
 */
$game = new Game();

#########################################
# GENERAL FUNCTIONS
#########################################

/**
 * @param mixed ...$arr
 * vd is auxiliary function for display information
 */
function vd(...$arr)
{
    echo "\n";
    foreach ($arr as $elem) {
        echo " {$elem} ";
    }
    echo "\n";
}

/**
 * Pick one random element out of an array, use probability
 * @param array $array
 * @param string $elem
 * key of element you want to increase receiving probability
 * @param float|null $probability
 * amount of receiving the element, 0 < $probability < 1
 * @return mixed|null
 * getRandomElem returns the key for a random element of an array and null if the array is empty
 */
function getRandomElem(array $array = [], string $elem = '', float $probability = null)
{
    if (empty($array)) {
        return null;
    }

    $totalAmount = 1000;
    $elemCount = count($array);
    $fortune = [];

    if ($probability !== null and (0 < $probability and $probability < 1)) {
        $selfAmount = $totalAmount * $probability;
        $totalAmount -= $selfAmount;
        $elemCount--;
    }

    $equalAmount = round($totalAmount / $elemCount);
    foreach ($array as $key => $value) {
        $amount = $equalAmount;
        if ($key == $elem and isset($selfAmount)) {
            $amount = $selfAmount;
        }
        for ($i = 0; $i < $amount; $i++) {
            $fortune[] = $key;
        }
    }
    shuffle ($fortune);
    $randElem = array_rand($fortune);

    return $fortune[$randElem];
}