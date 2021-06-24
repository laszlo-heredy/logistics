<?php

class Exercise
{
    protected $drivers   = [];
    protected $addresses = [];

    /**
     * @var array keyed by both "$driver $address" and "$address $driver", each with value suitability score for the pair.
     */
    protected $index  = [];
    protected $output = [];

    public function __construct()
    {
        $this->addresses = (new Addresses())->getIterator();
        $this->drivers   = (new Drivers())->getIterator();

        $this->doTheExercise();
    }

    public function doTheExercise(): void
    {
        $this->doFillIndexes();

        $this->output = $this->index;
    }

    /**
     * Populate index with Suitability Score for the driver, address pair, both ways.
     *
     * @throws Exception
     */
    public function doFillIndexes(): void
    {
        foreach ($this->drivers as $driver) {
            foreach ($this->addresses as $address) {
                $suitability_score = Util::getSuitabilityScore($address, $driver);

                $this->index["$driver $address"] = $suitability_score;
            }
        }
    }

    public function __toString(): string
    {
        return (string)print_r($this->output, true) . PHP_EOL;
    }
}