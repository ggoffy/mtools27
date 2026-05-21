<?php

namespace Tests\Unit\AutoRoute\HttpIgnore\Repo\Issue;

use AutoRoute\HttpIgnore\Repo\Issue\GetRepoIssue;
use PHPUnit\Framework\TestCase;

/**
 * Class GetRepoIssueTest.
 *
 * @covers \AutoRoute\HttpIgnore\Repo\Issue\GetRepoIssue
 */
final class GetRepoIssueTest extends TestCase
{
    private GetRepoIssue $getRepoIssue;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getRepoIssue = new GetRepoIssue();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getRepoIssue);
    }

    public function testExec(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
