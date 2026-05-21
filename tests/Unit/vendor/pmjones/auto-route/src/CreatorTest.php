<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Config;
use AutoRoute\Creator;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

/**
 * Class CreatorTest.
 *
 * @covers \AutoRoute\Creator
 */
final class CreatorTest extends TestCase
{
    private Creator $creator;

    private Config|Mock $config;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->config = Mockery::mock(Config::class);
        $this->creator = new Creator($this->config);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->creator);
        unset($this->config);
    }

    public function testCreate(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testParse(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
