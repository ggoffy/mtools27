<?php

namespace Tests\Unit\AutoRoute\HttpIgnore\FooItems\Archive;

use AutoRoute\HttpIgnore\FooItems\Archive\GetFooItemsArchive;
use PHPUnit\Framework\TestCase;

/**
 * Class GetFooItemsArchiveTest.
 *
 * @covers \AutoRoute\HttpIgnore\FooItems\Archive\GetFooItemsArchive
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

    public function testExec(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
