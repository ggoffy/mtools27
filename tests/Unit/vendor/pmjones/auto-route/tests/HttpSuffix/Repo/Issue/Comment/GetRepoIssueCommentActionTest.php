<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\Repo\Issue\Comment;

use AutoRoute\HttpSuffix\Repo\Issue\Comment\GetRepoIssueCommentAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetRepoIssueCommentActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\Repo\Issue\Comment\GetRepoIssueCommentAction
 */
final class GetRepoIssueCommentActionTest extends TestCase
{
    private GetRepoIssueCommentAction $getRepoIssueCommentAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getRepoIssueCommentAction = new GetRepoIssueCommentAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getRepoIssueCommentAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
