<?php

namespace Tests\Unit\AutoRoute\HttpIgnore\FooItem\Extras;

use AutoRoute\HttpIgnore\FooItem\Extras\GetFooItemExtras;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemExtrasTest.
 *
 * @covers \AutoRoute\HttpIgnore\FooItem\Extras\GetFooItemExtras
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

    public function testExec(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
