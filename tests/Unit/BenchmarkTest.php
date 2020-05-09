<?php

namespace Asad\Bench\Tests;

use Asad\Bench\Benchmark;
use Orchestra\Testbench\TestCase;

class BenchmarkTest extends TestCase
{
    protected $bench;
    public function setUp(): void
    {
        parent::setUp();
        $this->bench = new Benchmark();
    }

    public function sizeProvider()
    {
        return array(
            array('90B', 90),
            array('1.47Kb', 1500),
            array('9.54Mb', 10000000),
        );
    }

    /**
     * @dataProvider sizeProvider
     */
    public function testreadableSize($expected, $size)
    {
        $this->assertEquals($expected, Benchmark::readableSize($size, '%.2f%s'));
    }

    public function timeProvider()
    {
        return array(
            array('900ms', 0.9004213),
            array('1.156s', 1.1557845),
        );
    }

    /**
     * @dataProvider timeProvider
     */
    public function testreadableElapsedTime($expected, $time)
    {
        $this->assertEquals($expected, Benchmark::readableElapsedTime($time, '%.3f%s'));
    }

    public function testGetTime()
    {
        $this->bench->start();
        $this->bench->end();

        $this->assertRegExp('/^[0-9.]+ms/', $this->bench->getTime());

        $this->bench->start();
        sleep(1);
        $this->bench->end();

        $this->assertRegExp('/^[0-9.]+s/', $this->bench->getTime());
        $this->assertInternalType('float', $this->bench->getTime(true));
        $this->assertRegExp('/^[0-9]+s/', $this->bench->getTime(false, '%d%s'));
    }

    public function testGetMemoryUsage()
    {
        $this->bench->start();
        $this->bench->end();

        $this->assertRegExp('/^[0-9.]+Mb/', $this->bench->getMemoryUsage());
        $this->assertInternalType('integer', $this->bench->getMemoryUsage(true));
        $this->assertRegExp('/^[0-9]+Mb/', $this->bench->getMemoryUsage(false, '%d%s'));
    }

    public function testGetMemoryPeak()
    {
        $this->assertRegExp('/^[0-9.]+Mb/', $this->bench->getMemoryPeak());
        $this->assertInternalType('integer', $this->bench->getMemoryPeak(true));
        $this->assertRegExp('/^[0-9]+Mb/', $this->bench->getMemoryPeak(false, '%d%s'));
    }

    public function testCallableWithoutArguments()
    {
        $result = $this->bench->run(function () {
            return true;
        });

        $this->assertTrue($result);
        $this->assertNotNull($this->bench->getTime());
        $this->assertNotNull($this->bench->getMemoryUsage());
        $this->assertNotNull($this->bench->getMemoryPeak());
    }

    public function testCallableWithArguments()
    {
        $result = $this->bench->run(function ($one, $two) {
            return $one + $two;
        }, 1, 2);

        $this->assertEquals(3, $result);
        $this->assertNotNull($this->bench->getTime());
        $this->assertNotNull($this->bench->getMemoryUsage());
        $this->assertNotNull($this->bench->getMemoryPeak());
    }

    public function testWasStart()
    {
        $this->assertFalse($this->bench->hasStarted());
        $this->bench->start();
        $this->assertTrue($this->bench->hasStarted());
    }

    public function testWasEnd()
    {
        $this->bench->start();

        $this->assertFalse($this->bench->hasEnded());
        $this->bench->end();
        $this->assertTrue($this->bench->hasEnded());
    }

    /**
     * @expectedException LogicException
     */
    public function testEndException()
    {
        $this->bench->end();
    }

    /**
     * @expectedException LogicException
     */
    public function testGetTimeExceptionWithoutStart()
    {
        $this->bench->getTime();
    }

    /**
     * @expectedException LogicException
     */
    public function testGetTimeExceptionWithoutEnd()
    {
        $this->bench->start();
        $this->bench->getTime();
    }
}
