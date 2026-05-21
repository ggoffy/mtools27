<?php

namespace Tests\Unit\Psr\Log;

use Psr\Log\LoggerTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class LoggerTraitTest.
 *
 * @covers \Psr\Log\LoggerTrait
 */
final class LoggerTraitTest extends TestCase
{
    private LoggerTrait $loggerTrait;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->loggerTrait = $this->getMockBuilder(LoggerTrait::class)
            ->setConstructorArgs([])
            ->getMockForTrait();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->loggerTrait);
    }

    public function testEmergency(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testAlert(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testCritical(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testError(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testWarning(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testNotice(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testInfo(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testDebug(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testLog(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
