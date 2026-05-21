<?php

namespace Tests\Unit\AutoRoute\HttpSuffix\Repo;

use AutoRoute\HttpSuffix\Repo\GetRepoAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetRepoActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\Repo\GetRepoAction
 */
final class GetRepoActionTest extends TestCase
{
    private GetRepoAction $getRepoAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getRepoAction = new GetRepoAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getRepoAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
