<?php

namespace PHPLepton;

use Exception;

/**
 * Class Lepton
 *
 * @package PHPLepton
 */
class Lepton
{
    protected $binaryPath;

    /**
     * Lepton Constructor
     *
     * @param string $binaryPath
     *
     * @throws \Exception
     */
    public function __construct($binaryPath)
    {
        if (! file_exists($binaryPath)) {
            throw new Exception('Binary path doesn\'t exist');
        }
        $this->binaryPath = $binaryPath;
    }


    /**
     * Compress image to .lep
     *
     * @param string $inputFile
     * @param string $outputFile
     * @param array  $parameters
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function compress($inputFile, $outputFile, $parameters = array())
    {
        if ('jpg' != pathinfo($inputFile, PATHINFO_EXTENSION) &&
            'jpeg' != pathinfo($inputFile, PATHINFO_EXTENSION)
        ) {
            throw new Exception('Input file must be a jpg or jpeg');
        }

        if ('lep' != pathinfo($outputFile, PATHINFO_EXTENSION)) {
            throw new Exception('Output file must be a .lep file');
        }

        $parameters = implode(' ', $parameters);

        exec($this->binaryPath.' '.$parameters.' '.escapeshellarg($inputFile).' '.escapeshellarg($outputFile).' 2>&1', $output, $returnValue);

        if (0 !== $returnValue) {
            throw new Exception('There was an error during the compression');
        }

        return true;
    }

    /**
     * Decompress .lep image
     *
     * @param string $inputFile
     * @param string $outputFile
     * @param array  $parameters
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function decompress($inputFile, $outputFile, $parameters = array())
    {
        if ('lep' != pathinfo($inputFile, PATHINFO_EXTENSION)) {
            throw new Exception('Input file must be a .lep file');
        }

        if ('jpg' != pathinfo($outputFile, PATHINFO_EXTENSION) &&
            'jpeg' != pathinfo($outputFile, PATHINFO_EXTENSION)
        ) {
            throw new Exception('Output file must be a jpg or jpeg');
        }

        $parameters = implode(' ', $parameters);

        exec($this->binaryPath.' '.$parameters.' '.escapeshellarg($inputFile).' '.escapeshellarg($outputFile).' 2>&1', $output, $returnValue);

        if (0 !== $returnValue) {
            throw new Exception('There was an error during the decompression');
        }

        return true;
    }
}
