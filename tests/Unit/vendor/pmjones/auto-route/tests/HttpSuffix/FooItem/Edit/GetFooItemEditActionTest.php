<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\FooItem\Edit;

use AutoRoute\HttpSuffix\FooItem\Edit\GetFooItemEditAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemEditActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\FooItem\Edit\GetFooItemEditAction
 */
final class GetFooItemEditActionTest extends TestCase
{
    private GetFooItemEditAction $getFooItemEditAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemEditAction = new GetFooItemEditAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemEditAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
