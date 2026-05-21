<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\Repo\Issue\Comment\Add;

use AutoRoute\HttpSuffix\Repo\Issue\Comment\Add\GetRepoIssueCommentAddAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetRepoIssueCommentAddActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\Repo\Issue\Comment\Add\GetRepoIssueCommentAddAction
 */
final class GetRepoIssueCommentAddActionTest extends TestCase
{
    private GetRepoIssueCommentAddAction $getRepoIssueCommentAddAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getRepoIssueCommentAddAction = new GetRepoIssueCommentAddAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getRepoIssueCommentAddAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
