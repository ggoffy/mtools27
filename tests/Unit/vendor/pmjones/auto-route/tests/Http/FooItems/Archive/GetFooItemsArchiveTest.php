<?php

namespace Tests\Unit\AutoRoute\Http\FooItems\Archive;

use AutoRoute\Http\FooItems\Archive\GetFooItemsArchive;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemsArchiveTest.
 *
 * @covers \AutoRoute\Http\FooItems\Archive\GetFooItemsArchive
 */
final class GetFooItemsArchiveTest extends TestCase
{
    private GetFooItemsArchive $getFooItemsArchive;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getFooItemsArchive = new GetFooItemsArchive();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getFooItemsArchive);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
