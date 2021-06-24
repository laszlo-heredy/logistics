<?php

class Exercise
{
    protected $drivers   = [];
    protected $addresses = [];

    /**
     * @var array keyed by "$driver $address", with value suitability score for the pair.
     */
    protected $index_driver_address_to_ss = [];

    /**
     * @var array keyed by suitability score, with value array of "$driver $address" values that have the same score.
     */
    protected $index_ss_to_array_of_pairs = [];


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

        $this->output = [
            $this->index_driver_address_to_ss,
            $this->index_ss_to_array_of_pairs,
        ];
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
                $pairing           = "$driver $address";

                $this->index_driver_address_to_ss[$pairing]               = $suitability_score;
                $this->index_ss_to_array_of_pairs["$suitability_score"][] = $pairing;
            }
        }
    }

    public function __toString(): string
    {
        return (string)print_r($this->output, true) . PHP_EOL;
    }
}