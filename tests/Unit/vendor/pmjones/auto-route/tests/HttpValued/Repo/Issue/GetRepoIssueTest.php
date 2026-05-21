<?php

namespace Tests\Unit\AutoRoute\HttpValued\Repo\Issue;

use AutoRoute\HttpValued\Repo\Issue\GetRepoIssue;
use PHPUnit\Framework\TestCase;

/**
 * Class GetRepoIssueTest.
 *
 * @covers \AutoRoute\HttpValued\Repo\Issue\GetRepoIssue
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

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
