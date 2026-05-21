<?php

namespace Tests\Unit\AutoRoute\Http\FooItems;

use AutoRoute\Http\FooItems\GetFooItems;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemsTest.
 *
 * @covers \AutoRoute\Http\FooItems\GetFooItems
 */
final class GetFooItemsTest extends TestCase
{
    private GetFooItems $getFooItems;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItems = new GetFooItems();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItems);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
