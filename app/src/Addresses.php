<?php

class Addresses extends FileReader
{
    protected const FILENAME    = 'addresses.txt';
    private const REGEX_ADDRESS = '/^\d+\w+(.*)$/';

    public function getParsedInput(string $line): ?string
    {
        if (!(preg_match(self::REGEX_ADDRESS, $line, $matches))) {
            return null;
        }

        return $matches[1];
    }
}