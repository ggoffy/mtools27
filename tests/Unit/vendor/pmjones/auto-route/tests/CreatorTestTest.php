<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\CreatorTest;
use PHPUnit\Framework\TestCase;

/**
 * Class CreatorTestTest.
 *
 * @covers \AutoRoute\CreatorTest
 */
final class CreatorTestTest extends TestCase
{
    private CreatorTest $creatorTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->creatorTest = new CreatorTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->creatorTest);
    }

    public function testTest(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
