<?php

class Exercise
{
    protected $drivers   = [];
    protected $addresses = [];
    protected $index     = [];

    protected $output;

    public function __construct()
    {
        $this->addresses = (new Addresses())->getIterator();
        $this->drivers   = (new Drivers())->getIterator();

        $this->doTheExercise();
    }

    public function doTheExercise(): void
    {

    }

    public function __toString(): string
    {
        return (string)print_r($this->output, true) . PHP_EOL;
    }
}