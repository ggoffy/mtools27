<?php

namespace Tests\Unit\AutoRoute\HttpValued\FooItem\Edit;

use AutoRoute\HttpValued\FooItem\Edit\GetFooItemEdit;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemEditTest.
 *
 * @covers \AutoRoute\HttpValued\FooItem\Edit\GetFooItemEdit
 */
final class GetFooItemEditTest extends TestCase
{
    private GetFooItemEdit $getFooItemEdit;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemEdit = new GetFooItemEdit();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemEdit);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
