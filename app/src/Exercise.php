<?php

class Exercise
{
    protected $output;

    public function __construct()
    {
        $this->doTheExercise();
    }

    public function doTheExercise(): void
    {
        $addresses = new Addresses();
        $drivers   = new Drivers();

        $this->output = [
            $addresses->getIterator(),
            $drivers->getIterator(),
        ];
    }

    public function __toString(): string
    {
        return (string)print_r($this->output, true) . PHP_EOL;
    }
}