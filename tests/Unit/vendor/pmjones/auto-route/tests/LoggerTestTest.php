<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\LoggerTest;
use PHPUnit\Framework\TestCase;

/**
 * Class LoggerTestTest.
 *
 * @covers \AutoRoute\LoggerTest
 */
final class LoggerTestTest extends TestCase
{
    private LoggerTest $loggerTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->loggerTest = new LoggerTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->loggerTest);
    }

    public function testTest(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
