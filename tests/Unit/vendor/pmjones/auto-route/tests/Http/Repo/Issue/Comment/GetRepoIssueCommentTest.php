<?php

namespace Tests\Unit\AutoRoute\Http\Repo\Issue\Comment;

use AutoRoute\Http\Repo\Issue\Comment\GetRepoIssueComment;
use PHPUnit\Framework\TestCase;

/**
 * Class GetRepoIssueCommentTest.
 *
 * @covers \AutoRoute\Http\Repo\Issue\Comment\GetRepoIssueComment
 */
final class GetRepoIssueCommentTest extends TestCase
{
    private GetRepoIssueComment $getRepoIssueComment;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getRepoIssueComment = new GetRepoIssueComment();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getRepoIssueComment);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
