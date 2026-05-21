<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\FooItems;

use AutoRoute\HttpSuffix\FooItems\GetFooItemsAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemsActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\FooItems\GetFooItemsAction
 */
final class GetFooItemsActionTest extends TestCase
{
    private GetFooItemsAction $getFooItemsAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemsAction = new GetFooItemsAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemsAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
