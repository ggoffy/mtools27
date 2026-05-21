<?php

namespace Tests\Unit\AutoRoute\HttpValued\FooItem;

use AutoRoute\HttpValued\FooItem\PostFooItem;
use PHPUnit\Framework\TestCase;

/**
 * Class PostFooItemTest.
 *
 * @covers \AutoRoute\HttpValued\FooItem\PostFooItem
 */
final class PostFooItemTest extends TestCase
{
    private PostFooItem $postFooItem;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->postFooItem = new PostFooItem();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->postFooItem);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
