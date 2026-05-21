<?php

namespace Tests\Unit\AutoRoute\Http\Repo\Issue\Comment\Add;

use AutoRoute\Http\Repo\Issue\Comment\Add\GetRepoIssueCommentAdd;
use PHPUnit\Framework\TestCase;

/**
 * Class GetRepoIssueCommentAddTest.
 *
 * @covers \AutoRoute\Http\Repo\Issue\Comment\Add\GetRepoIssueCommentAdd
 */
final class GetRepoIssueCommentAddTest extends TestCase
{
    private GetRepoIssueCommentAdd $getRepoIssueCommentAdd;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getRepoIssueCommentAdd = new GetRepoIssueCommentAdd();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getRepoIssueCommentAdd);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
