<?php

namespace Tests\Unit\AutoRoute\Http\FooItem;

use AutoRoute\Http\FooItem\GetFooItem;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemTest.
 *
 * @covers \AutoRoute\Http\FooItem\GetFooItem
 */
final class GetFooItemTest extends TestCase
{
    private GetFooItem $getFooItem;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItem = new GetFooItem();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItem);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
