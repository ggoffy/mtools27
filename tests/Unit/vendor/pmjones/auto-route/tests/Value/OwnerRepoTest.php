<?php

namespace Tests\Unit\AutoRoute\Value;

use AutoRoute\Value\OwnerRepo;
use PHPUnit\Framework\TestCase;

/**
 * Class OwnerRepoTest.
 *
 * @covers \AutoRoute\Value\OwnerRepo
 */
final class OwnerRepoTest extends TestCase
{
    private OwnerRepo $ownerRepo;

    private string $ownerName;

    private string $repoName;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->ownerName = '42';
        $this->repoName = '42';
        $this->ownerRepo = new OwnerRepo($this->ownerName, $this->repoName);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->ownerRepo);
        unset($this->ownerName);
        unset($this->repoName);
    }

    public function testGet(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
