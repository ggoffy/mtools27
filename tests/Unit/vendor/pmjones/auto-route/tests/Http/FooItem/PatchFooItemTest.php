<?php

namespace Tests\Unit\AutoRoute\Http\FooItem;

use AutoRoute\Http\FooItem\PatchFooItem;
use PHPUnit\Framework\TestCase;

/**
 * Class PatchFooItemTest.
 *
 * @covers \AutoRoute\Http\FooItem\PatchFooItem
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

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
