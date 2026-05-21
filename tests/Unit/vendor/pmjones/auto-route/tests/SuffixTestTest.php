<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\SuffixTest;
use PHPUnit\Framework\TestCase;

/**
 * Class SuffixTestTest.
 *
 * @covers \AutoRoute\SuffixTest
 */
final class SuffixTestTest extends TestCase
{
    private SuffixTest $suffixTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->suffixTest = new SuffixTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->suffixTest);
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
