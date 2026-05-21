<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\FooItem;

use AutoRoute\HttpSuffix\FooItem\GetFooItemAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\FooItem\GetFooItemAction
 */
final class GetFooItemActionTest extends TestCase
{
    private GetFooItemAction $getFooItemAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemAction = new GetFooItemAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
