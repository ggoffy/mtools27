<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\FooItem\Variadic;

use AutoRoute\HttpSuffix\FooItem\Variadic\GetFooItemVariadicAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemVariadicActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\FooItem\Variadic\GetFooItemVariadicAction
 */
final class GetFooItemVariadicActionTest extends TestCase
{
    private GetFooItemVariadicAction $getFooItemVariadicAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemVariadicAction = new GetFooItemVariadicAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemVariadicAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
