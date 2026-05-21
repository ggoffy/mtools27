<?php

namespace Tests\Unit\XoopsModules\Mtools\Common;

use PHPUnit\Framework\TestCase;
use XoopsModules\Mtools\Common\ModuleStats;

/**
 * Class ModuleStatsTest.
 *
 * @copyright 2000-2026 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Michael Beck <mambax7@gmail.com>
 *
 * @covers \XoopsModules\Mtools\Common\ModuleStats
 */
final class ModuleStatsTest extends TestCase
{
    private ModuleStats $moduleStats;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->moduleStats = $this->getMockBuilder(ModuleStats::class)
            ->setConstructorArgs([])
            ->getMockForTrait();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->moduleStats);
    }

    public function testGetModuleStats(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
