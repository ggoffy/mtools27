<?php

namespace Tests\Unit\AutoRoute\HttpIgnore\FooItem;

use AutoRoute\HttpIgnore\FooItem\GetFooItem;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemTest.
 *
 * @covers \AutoRoute\HttpIgnore\FooItem\GetFooItem
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

    public function testExec(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
