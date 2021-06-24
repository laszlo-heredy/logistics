<?php

class Exercise
{
    public const CHARACTER_PAIR_DRIVER_ADDRESS_SPLIT = '|';

    /*
     * Arrays of strings, input from file, but processed.
     */
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

    /**
     * @var array that is dumped as part of __toString().
     */
    protected $output = [];

    /**
     * Load file inputs, and process as instructed.
     */
    public function __construct()
    {
        $this->addresses = (new Addresses())->getIterator();
        $this->drivers   = (new Drivers())->getIterator();

        $this->doTheExercise();
    }

    /**
     * Facilitate finding optimal driver-address pairings based on Suitability Score.
     *
     * @throws Exception
     */
    public function doTheExercise(): void
    {
        $this->doFillIndexes();
        $this->doChooseIdealPairings();
    }

    /**
     * Use indexes to find optimal driver-address pairings based on Suitability Score.
     *
     * Output should include all ideal parings and a single value for the total sum of SS.
     */
    public function doChooseIdealPairings(): void
    {
        /*
         * TODO:
         *  - While-Pop this SS-keyed index (highest first)
         *  - If only one pair, great! Move on to next lowest SS score, and ignore any pairs including used driver/street.
         *  - If more than one pair, check each pair member in the other indexes for the next highest, choosing the pairings with the highest SS sum, then move on.
         * ...
         * [LFH 2021-06-23]
         */

        // Temporarily, output indexes while working.
        $this->output = [
            $this->index_driver_address_to_ss,
            $this->index_ss_to_array_of_pairs,
        ];
    }

    /**
     * Populate index with Suitability Score for the driver, address pair, both ways.
     *
     * Notes:
     * - Double-quotes around Suitability Score for index is important to keep float value as string for array key.
     *
     * @throws Exception
     */
    public function doFillIndexes(): void
    {
        foreach ($this->drivers as $driver) {
            foreach ($this->addresses as $address) {
                $suitability_score = Util::getSuitabilityScore($address, $driver);
                $delimiter         = self::CHARACTER_PAIR_DRIVER_ADDRESS_SPLIT;
                $pairing           = "$driver$delimiter$address";

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