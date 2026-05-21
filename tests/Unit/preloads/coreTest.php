<?php

namespace Tests\Unit;

use MtoolsCorePreload;
use PHPUnit\Framework\TestCase;

/**
 * Class MtoolsCorePreloadTest.
 *
 * @covers \MtoolsCorePreload
 */
final class MtoolsCorePreloadTest extends TestCase
{
    private MtoolsCorePreload $mtoolsCorePreload;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->mtoolsCorePreload = new MtoolsCorePreload();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->mtoolsCorePreload);
    }

    public function testEventCoreFooterStart(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testEventCoreIncludeCommonEnd(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
