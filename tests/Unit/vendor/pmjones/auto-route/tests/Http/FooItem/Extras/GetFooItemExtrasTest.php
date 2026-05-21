<?php

namespace Tests\Unit\AutoRoute\Http\FooItem\Extras;

use AutoRoute\Http\FooItem\Extras\GetFooItemExtras;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemExtrasTest.
 *
 * @covers \AutoRoute\Http\FooItem\Extras\GetFooItemExtras
 */
final class GetFooItemExtrasTest extends TestCase
{
    private GetFooItemExtras $getFooItemExtras;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemExtras = new GetFooItemExtras();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemExtras);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
