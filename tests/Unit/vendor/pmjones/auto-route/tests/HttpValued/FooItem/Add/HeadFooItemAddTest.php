<?php

namespace Tests\Unit\AutoRoute\HttpValued\FooItem\Add;

use AutoRoute\HttpValued\FooItem\Add\HeadFooItemAdd;
use PHPUnit\Framework\TestCase;

/**
 * Class HeadFooItemAddTest.
 *
 * @covers \AutoRoute\HttpValued\FooItem\Add\HeadFooItemAdd
 */
final class HeadFooItemAddTest extends TestCase
{
    private HeadFooItemAdd $headFooItemAdd;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->headFooItemAdd = new HeadFooItemAdd();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->headFooItemAdd);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
