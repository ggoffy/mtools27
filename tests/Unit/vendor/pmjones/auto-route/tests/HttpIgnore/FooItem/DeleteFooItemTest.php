<?php

namespace Tests\Unit\AutoRoute\HttpIgnore\FooItem;

use AutoRoute\HttpIgnore\FooItem\DeleteFooItem;
use PHPUnit\Framework\TestCase;

/**
 * Class DeleteFooItemTest.
 *
 * @covers \AutoRoute\HttpIgnore\FooItem\DeleteFooItem
 */
final class DeleteFooItemTest extends TestCase
{
    private DeleteFooItem $deleteFooItem;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->deleteFooItem = new DeleteFooItem();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->deleteFooItem);
    }

    public function testExec(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
