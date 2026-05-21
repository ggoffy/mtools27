<?php

namespace Tests\Unit\AutoRoute\HttpValued\Admin\Dashboard;

use AutoRoute\HttpValued\Admin\Dashboard\GetAdminDashboard;
use PHPUnit\Framework\TestCase;

/**
 * Class GetAdminDashboardTest.
 *
 * @covers \AutoRoute\HttpValued\Admin\Dashboard\GetAdminDashboard
 */
final class GetAdminDashboardTest extends TestCase
{
    private GetAdminDashboard $getAdminDashboard;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getAdminDashboard = new GetAdminDashboard();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getAdminDashboard);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
