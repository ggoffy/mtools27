<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\ReflectorTest;
use PHPUnit\Framework\TestCase;

/**
 * Class ReflectorTestTest.
 *
 * @covers \AutoRoute\ReflectorTest
 */
final class ReflectorTestTest extends TestCase
{
    private ReflectorTest $reflectorTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->reflectorTest = new ReflectorTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->reflectorTest);
    }

    public function testTest(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
