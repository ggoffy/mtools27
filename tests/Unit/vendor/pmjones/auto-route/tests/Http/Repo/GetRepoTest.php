<?php

namespace Tests\Unit\AutoRoute\Http\Repo;

use AutoRoute\Http\Repo\GetRepo;
use PHPUnit\Framework\TestCase;

/**
 * Class GetRepoTest.
 *
 * @covers \AutoRoute\Http\Repo\GetRepo
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

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
