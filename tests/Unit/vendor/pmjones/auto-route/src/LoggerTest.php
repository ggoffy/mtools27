<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Logger;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class LoggerTest.
 *
 * @covers \AutoRoute\Logger
 */
final class LoggerTest extends TestCase
{
    private Logger $logger;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->logger = new Logger();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->logger);
    }

    public function testLog(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetMessages(): void
    {
        $expected = [];
        $property = (new ReflectionClass(Logger::class))
            ->getProperty('messages');
        $property->setAccessible(true);
        $property->setValue($this->logger, $expected);
        $this->assertSame($expected, $this->logger->getMessages());
    }

    public function testReset(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
