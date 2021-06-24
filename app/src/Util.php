<?php

class Util
{
    public static function getSuitabilityScore(string $address, string $driver): float
    {

    }

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