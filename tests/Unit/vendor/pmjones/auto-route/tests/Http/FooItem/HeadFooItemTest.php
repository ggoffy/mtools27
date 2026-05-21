<?php

namespace Tests\Unit\AutoRoute\Http\FooItem;

use AutoRoute\Http\FooItem\HeadFooItem;
use PHPUnit\Framework\TestCase;

/**
 * Class HeadFooItemTest.
 *
 * @covers \AutoRoute\Http\FooItem\HeadFooItem
 */
final class HeadFooItemTest extends TestCase
{
    private HeadFooItem $headFooItem;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->headFooItem = new HeadFooItem();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->headFooItem);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
