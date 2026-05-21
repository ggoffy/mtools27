<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\Repo\Issue;

use AutoRoute\HttpSuffix\Repo\Issue\GetRepoIssueAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetRepoIssueActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\Repo\Issue\GetRepoIssueAction
 */
final class GetRepoIssueActionTest extends TestCase
{
    private GetRepoIssueAction $getRepoIssueAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getRepoIssueAction = new GetRepoIssueAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getRepoIssueAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
