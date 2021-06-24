<?php

class Util
{
    public const REGEX_VOWELS = '/aeiou/i';

    /**
     * Returns a number (float) based on this super-secret formula:
     *
     * If the length of the shipment's destination street name is even, the base suitability score (SS) is the number of vowels in the driver’s name multiplied by 1.5.
     * If the length of the shipment's destination street name is odd, the base SS is the number of consonants in the driver’s name multiplied by 1.
     * If the length of the shipment's destination street name shares any common factors (besides 1) with the length of the driver’s name, the SS is increased by 50% above the base SS.
     *
     * @param string $address
     * @param string $driver
     *
     * @return float
     */
    public static function getSuitabilityScore(string $address, string $driver): float
    {

    }

    public static function getBaseSuitabilityScore(string $address, string $driver): float
    {

    }

    /**
     * Returns true if input length is even, false otherwise.
     *
     * @param string $input
     *
     * @return bool
     */
    public static function isStringLengthEven(string $input): bool
    {
        if (strlen($input) % 2 !== 0) {
            return false;
        }

        return true;
    }

    public static function getCountVowels(string $input): int
    {
        return (int)preg_match_all(static::REGEX_VOWELS, $input, $unused);
    }

    public static function getCountConsonants(string $input): int
    {
        return strlen($input) - static::getCountVowels($input);
    }

    /**
     * Returns array with factors of $int, not including $int itself or 1.
     *
     * @param int $int
     *
     * @return array
     *
     * @throws Exception
     */
    public static function getFactors(int $int): array
    {
        if ($int < 0) {
            throw new \Exception('Todo: consider negative numbers!');
        }

        $factors = [];

        for ($i = 2; $i < $int; $i++) {
            if ($int % $i !== 0) {
                continue;
            }

            $factors[] = $i;
        }

        return $factors;
    }

    /**
     * Returns true if the integer pair shares factors other than 1, false otherwise.
     *
     * @param int $int_1
     * @param int $int_2
     *
     * @throws Exception
     *
     * @return bool
     */
    public static function isSharesFactors(int $int_1, int $int_2): bool
    {
        $factors_1 = static::getFactors($int_1);
        $factors_2 = static::getFactors($int_2);

        return (bool)(count(array_intersect($factors_1, $factors_2)));
    }
}