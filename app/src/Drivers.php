<?php

class Drivers extends FileReader
{
    protected const FILENAME        = 'drivers.txt';
    protected const NAME_MIN_LENGTH = 2;

    public function getParsedInput(string $line): ?string
    {
        if (strlen($line) < self::NAME_MIN_LENGTH) {
            return null;
        }

        return trim((string)$line);
    }
}