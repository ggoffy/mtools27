<?php

namespace Tests\Unit\Psr\Log;

use Psr\Log\NullLogger;
use PHPUnit\Framework\TestCase;

/**
 * Class NullLoggerTest.
 *
 * @covers \Psr\Log\NullLogger
 */
final class NullLoggerTest extends TestCase
{
    private NullLogger $nullLogger;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->nullLogger = new NullLogger();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->nullLogger);
    }

    public function testLog(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
