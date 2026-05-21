<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\FooItem;

use AutoRoute\HttpSuffix\FooItem\PostFooItemAction;
use PHPUnit\Framework\TestCase;

/**
 * Class PostFooItemActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\FooItem\PostFooItemAction
 */
final class PostFooItemActionTest extends TestCase
{
    private PostFooItemAction $postFooItemAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->postFooItemAction = new PostFooItemAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->postFooItemAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
