<?php

abstract class FileReader
{
    protected const FILENAME = '';

    protected $iterator = [];

    /**
     * Custom class-level parsing to only ingest desired parts of input.
     *
     * @return string
     */
    abstract protected function getParsedInput(string $line): ?string;

    public final function __construct()
    {
        if (!(static::FILENAME)) {
            throw new \LogicException('Incorrectly-configured superclass for FileReader: missing FILENAME definition.');
        }

        $this->doReadContents();
    }

    private final function doReadContents(): void
    {
        if (!(file_exists($filename = DIR_INPUTS . static::FILENAME))) {
            throw new \Exception('File System error: path not found: '. $filename);
        }

        $handle = fopen($filename, 'r');

        while ($line = fgets($handle)) {
            if (null === $input = $this->getParsedInput($line)) {
                continue;
            }

            $this->iterator[] = $input;
        }

        fclose($handle);
    }

    public function getIterator(): iterable
    {
        return (array)$this->iterator;
    }
}