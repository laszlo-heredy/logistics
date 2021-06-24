<?php

class Exercise
{
    protected $output;

    public function __construct()
    {
        $this->output = 'okay';
    }

    public function __toString(): string
    {
        return (string)print_r($this->output, true) . PHP_EOL;
    }
}