<?php

class Util
{
    public const REGEX_VOWELS = '/aeiou/i';

    protected const MULTIPLIER_EVEN_VOWEL          = 1.5;
    protected const MULTIPLIER_ODD_CONSONANT       = 1.0;
    protected const MULTIPLIER_COMMON_FACTORS      = 1.5;
    protected const MULTIPLIER_COMMON_FACTORS_NONE = 1.0;

    /**
     * Returns a number (float) based on our super-secret formula:
     *
     * Rules:
     * 1. If the length of the shipment's destination street name is even, the base suitability score (SS) is the number of vowels in the driver’s name multiplied by 1.5.
     * 2. If the length of the shipment's destination street name is odd, the base SS is the number of consonants in the driver’s name multiplied by 1.
     * 3. If the length of the shipment's destination street name shares any common factors (besides 1) with the length of the driver’s name, the SS is increased by 50% above the base SS.
     *
     * @param string $address
     * @param string $driver
     *
     * @throws Exception in case of factoring negative numbers.
     *
     * @return float
     */
    public static function getSuitabilityScore(string $address, string $driver): float
    {
        return static::getBaseSuitabilityScore($address, $driver) * static::getMultiplierCommonFactors($address, $driver);
    }

    /**
     * Handles rules 1 and 2 of getSuitabilityScore().
     *
     * @param string $address
     * @param string $driver
     *
     * @return float
     */
    public static function getBaseSuitabilityScore(string $address, string $driver): float
    {
        if (static::isStringLengthEven($address)) {
            return static::MULTIPLIER_EVEN_VOWEL * static::getCountConsonants($driver);
        }

        return static::MULTIPLIER_ODD_CONSONANT * static::getCountConsonants($driver);
    }

    /**
     * Returns float multiplier for the third rule of getSuitabilityScore().
     *
     * @param $address
     * @param $driver
     *
     * @throws Exception
     *
     * @return float
     */
    public static function getMultiplierCommonFactors($address, $driver): float
    {
        if (static::isSharesFactors(strlen($address), strlen($driver))) {
            return static::MULTIPLIER_COMMON_FACTORS;
        }

        return static::MULTIPLIER_COMMON_FACTORS_NONE;
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