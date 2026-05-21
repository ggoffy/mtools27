<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\Admin\Dashboard;

use AutoRoute\HttpSuffix\Admin\Dashboard\GetAdminDashboardAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetAdminDashboardActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\Admin\Dashboard\GetAdminDashboardAction
 */
final class GetAdminDashboardActionTest extends TestCase
{
    private GetAdminDashboardAction $getAdminDashboardAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getAdminDashboardAction = new GetAdminDashboardAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getAdminDashboardAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
