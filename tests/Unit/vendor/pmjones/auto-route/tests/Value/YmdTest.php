<?php

namespace Tests\Unit\AutoRoute\Value;

use AutoRoute\Value\Ymd;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class YmdTest.
 *
 * @covers \AutoRoute\Value\Ymd
 */
final class YmdTest extends TestCase
{
    private Ymd $ymd;

    private int $year;

    private int $month;

    private int $day;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->year = 42;
        $this->month = 42;
        $this->day = 42;
        $this->ymd = new Ymd($this->year, $this->month, $this->day);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->ymd);
        unset($this->year);
        unset($this->month);
        unset($this->day);
    }

    public function testGetYear(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Ymd::class))
            ->getProperty('year');
        $property->setAccessible(true);
        $property->setValue($this->ymd, $expected);
        $this->assertSame($expected, $this->ymd->getYear());
    }

    public function testGetMonth(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Ymd::class))
            ->getProperty('month');
        $property->setAccessible(true);
        $property->setValue($this->ymd, $expected);
        $this->assertSame($expected, $this->ymd->getMonth());
    }

    public function testGetDay(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Ymd::class))
            ->getProperty('day');
        $property->setAccessible(true);
        $property->setValue($this->ymd, $expected);
        $this->assertSame($expected, $this->ymd->getDay());
    }
}
