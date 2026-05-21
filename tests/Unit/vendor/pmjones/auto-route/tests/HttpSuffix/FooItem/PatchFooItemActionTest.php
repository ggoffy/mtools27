<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\FooItem;

use AutoRoute\HttpSuffix\FooItem\PatchFooItemAction;
use PHPUnit\Framework\TestCase;

/**
 * Class PatchFooItemActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\FooItem\PatchFooItemAction
 */
final class PatchFooItemActionTest extends TestCase
{
    private PatchFooItemAction $patchFooItemAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->patchFooItemAction = new PatchFooItemAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->patchFooItemAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
