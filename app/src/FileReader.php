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
    }

    private final function doReadContents(): void
    {
        if (!(file_exists($filename = BASE_DIR . DIRECTORY_SEPARATOR . static::FILENAME))) {
            throw new \Exception('File System error: file not found in inputs directory:' . static::FILENAME);
        }

        $handle = fopen($filename, 'r');

        while ($line = fgets($handle)) {
            if (null === $line) {
                continue;
            }

            $this->iterator[] = $this->getParsedInput($line);
        }
    }
}