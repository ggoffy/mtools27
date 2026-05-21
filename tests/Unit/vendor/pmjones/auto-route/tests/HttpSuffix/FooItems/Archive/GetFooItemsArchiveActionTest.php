<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\FooItems\Archive;

use AutoRoute\HttpSuffix\FooItems\Archive\GetFooItemsArchiveAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemsArchiveActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\FooItems\Archive\GetFooItemsArchiveAction
 */
final class GetFooItemsArchiveActionTest extends TestCase
{
    private GetFooItemsArchiveAction $getFooItemsArchiveAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemsArchiveAction = new GetFooItemsArchiveAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemsArchiveAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
