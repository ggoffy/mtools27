<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\FooItem\Extras;

use AutoRoute\HttpSuffix\FooItem\Extras\GetFooItemExtrasAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemExtrasActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\FooItem\Extras\GetFooItemExtrasAction
 */
final class GetFooItemExtrasActionTest extends TestCase
{
    private GetFooItemExtrasAction $getFooItemExtrasAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemExtrasAction = new GetFooItemExtrasAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemExtrasAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
