<?php

namespace Tests\Unit\AutoRoute\HttpValued\FooItem;

use AutoRoute\HttpValued\FooItem\HeadFooItem;
use PHPUnit\Framework\TestCase;

/**
 * Class HeadFooItemTest.
 *
 * @covers \AutoRoute\HttpValued\FooItem\HeadFooItem
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
