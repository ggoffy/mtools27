<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\DumperTest;
use PHPUnit\Framework\TestCase;

/**
 * Class DumperTestTest.
 *
 * @covers \AutoRoute\DumperTest
 */
final class DumperTestTest extends TestCase
{
    private DumperTest $dumperTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->dumperTest = new DumperTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->dumperTest);
    }

    public function testTestDumpRoutes(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestDumpRoutes_noBaseUrl(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
