<?php

namespace Tests\Unit\AutoRoute\HttpIgnore\FooItem;

use AutoRoute\HttpIgnore\FooItem\PatchFooItem;
use PHPUnit\Framework\TestCase;

/**
 * Class PatchFooItemTest.
 *
 * @covers \AutoRoute\HttpIgnore\FooItem\PatchFooItem
 */
final class PatchFooItemTest extends TestCase
{
    private PatchFooItem $patchFooItem;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->patchFooItem = new PatchFooItem();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->patchFooItem);
    }

    public function testExec(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
