<?php

namespace Tests\Unit;

use Repository;
use PHPUnit\Framework\TestCase;

/**
 * Class RepositoryTest.
 *
 * @covers \Repository
 */
final class RepositoryTest extends TestCase
{
    private Repository $repository;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->repository = new Repository();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->repository);
    }

    public function testLoad(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
