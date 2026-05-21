<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\IgnoreTest;
use PHPUnit\Framework\TestCase;

/**
 * Class IgnoreTestTest.
 *
 * @covers \AutoRoute\IgnoreTest
 */
final class IgnoreTestTest extends TestCase
{
    private IgnoreTest $ignoreTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->ignoreTest = new IgnoreTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->ignoreTest);
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
