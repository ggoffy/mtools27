<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\FooItem;

use AutoRoute\HttpSuffix\FooItem\DeleteFooItemAction;
use PHPUnit\Framework\TestCase;

/**
 * Class DeleteFooItemActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\FooItem\DeleteFooItemAction
 */
final class DeleteFooItemActionTest extends TestCase
{
    private DeleteFooItemAction $deleteFooItemAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->deleteFooItemAction = new DeleteFooItemAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->deleteFooItemAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
