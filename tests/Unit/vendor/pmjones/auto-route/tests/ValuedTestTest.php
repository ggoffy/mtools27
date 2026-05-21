<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\ValuedTest;
use PHPUnit\Framework\TestCase;

/**
 * Class ValuedTestTest.
 *
 * @covers \AutoRoute\ValuedTest
 */
final class ValuedTestTest extends TestCase
{
    private ValuedTest $valuedTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->valuedTest = new ValuedTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->valuedTest);
    }

    public function testTestRouter(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGenerator(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestDumper(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
