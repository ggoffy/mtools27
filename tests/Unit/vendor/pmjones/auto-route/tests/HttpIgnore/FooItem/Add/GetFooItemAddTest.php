<?php

namespace Tests\Unit\AutoRoute\HttpIgnore\FooItem\Add;

use AutoRoute\HttpIgnore\FooItem\Add\GetFooItemAdd;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemAddTest.
 *
 * @covers \AutoRoute\HttpIgnore\FooItem\Add\GetFooItemAdd
 */
final class GetFooItemAddTest extends TestCase
{
    private GetFooItemAdd $getFooItemAdd;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemAdd = new GetFooItemAdd();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemAdd);
    }

    public function testExec(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
