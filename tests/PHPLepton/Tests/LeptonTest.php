<?php

namespace PHPLepton\Tests;

use Exception;
use PHPLepton\Lepton;
use PHPUnit_Framework_TestCase;

/**
 * Class LeptonTest
 *
 * @package PHPLepton\Tests
 */
class LeptonTest extends PHPUnit_Framework_TestCase
{
    /**
     * Simple compress and decompress test
     */
    public function testSimpleCompressionAndDecompressionSuccess()
    {
        $lepton = new Lepton('/usr/local/bin/lepton');
        $compressionResult = $lepton->compress(
            __DIR__.'/Images/bridge.jpg',
            __DIR__.'/Images/bridge.lep'
        );

        $this->assertTrue($compressionResult);
        $this->assertTrue(file_exists(__DIR__.'/Images/bridge.lep'));

        $decompressionResult = $lepton->decompress(
            __DIR__.'/Images/bridge.lep',
            __DIR__.'/Images/bridge.jpg'
        );

        $this->assertTrue($decompressionResult);

        unlink(__DIR__.'/Images/bridge.lep');
    }

    /**
     * Advanced compress and decompress test
     */
    public function testAdvancedCompressionAndDecompressionSuccess()
    {
        $lepton = new Lepton('/usr/local/bin/lepton');
        $compressionResult = $lepton->compress(
            __DIR__.'/Images/newYork.jpg',
            __DIR__.'/Images/newYork.lep',
            array(
                '-allowprogressive',
            )
        );

        $this->assertTrue($compressionResult);
        $this->assertTrue(file_exists(__DIR__.'/Images/newYork.lep'));

        $decompressionResult = $lepton->decompress(
            __DIR__.'/Images/newYork.lep',
            __DIR__.'/Images/newYork.jpg',
            array(
                '-allowprogressive',
            )
        );

        $this->assertTrue($decompressionResult);

        unlink(__DIR__.'/Images/newYork.lep');
    }

    /**
     * Simple compress and decompress exception test
     */
    public function testSimpleCompressionException()
    {
        $lepton = new Lepton('/usr/local/bin/lepton');

        try {
            $compressionResult = $lepton->compress(
                __DIR__.'/Images/bridge.png',
                __DIR__.'/Images/bridge.lep'
            );
        } catch (Exception $e) {
            $this->assertEquals($e->getMessage(), 'Input file must be a jpg or jpeg');

            return;
        }

        $this->fail('Expected Exception has not been raised');
    }
}
