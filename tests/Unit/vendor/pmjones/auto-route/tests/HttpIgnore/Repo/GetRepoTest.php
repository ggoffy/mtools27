<?php

namespace Tests\Unit\AutoRoute\HttpIgnore\Repo;

use AutoRoute\HttpIgnore\Repo\GetRepo;
use PHPUnit\Framework\TestCase;

/**
 * Class GetRepoTest.
 *
 * @covers \AutoRoute\HttpIgnore\Repo\GetRepo
 */
final class GetRepoTest extends TestCase
{
    private GetRepo $getRepo;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getRepo = new GetRepo();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getRepo);
    }

    public function testExec(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
