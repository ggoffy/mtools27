<?php

namespace Tests\Unit\AutoRoute\HttpValued\FooItem\Variadic;

use AutoRoute\HttpValued\FooItem\Variadic\GetFooItemVariadic;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemVariadicTest.
 *
 * @covers \AutoRoute\HttpValued\FooItem\Variadic\GetFooItemVariadic
 */
final class GetFooItemVariadicTest extends TestCase
{
    private GetFooItemVariadic $getFooItemVariadic;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemVariadic = new GetFooItemVariadic();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemVariadic);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
