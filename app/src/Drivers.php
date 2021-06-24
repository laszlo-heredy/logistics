<?php

class Drivers extends FileReader
{
    protected const FILENAME = 'drivers.txt';

    public function getParsedInput(string $line): ?string
    {
        if (strlen($line) < 1) {
            return null;
        }

        return (string)$line;
    }
}