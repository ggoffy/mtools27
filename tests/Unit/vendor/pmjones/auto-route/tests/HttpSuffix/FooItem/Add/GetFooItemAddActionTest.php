<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\FooItem\Add;

use AutoRoute\HttpSuffix\FooItem\Add\GetFooItemAddAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemAddActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\FooItem\Add\GetFooItemAddAction
 */
final class GetFooItemAddActionTest extends TestCase
{
    private GetFooItemAddAction $getFooItemAddAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemAddAction = new GetFooItemAddAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemAddAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
