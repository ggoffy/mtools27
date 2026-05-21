<?php

namespace Tests\Unit\XoopsModules\Mtools\Common;


use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use XoopsModules\Mtools\Common\TestdataSample;

/**
 * Class TestdataSampleTest.
 *
 * @covers \XoopsModules\Mtools\Common\TestdataSample
 */
final class TestdataSampleTest extends TestCase
{
    private TestdataSample $testdataSample;

    private |Mock $modHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->modHelper = Mockery::mock(::class);
        $this->testdataSample = new TestdataSample($this->modHelper);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->testdataSample);
        unset($this->modHelper);
    }

    public function testLoadData(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSaveData(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testExportSchema(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testClearData(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
