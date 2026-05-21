<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Actions;
use AutoRoute\Config;
use AutoRoute\Reverser;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

/**
 * Class ReverserTest.
 *
 * @covers \AutoRoute\Reverser
 */
final class ReverserTest extends TestCase
{
    private Reverser $reverser;

    private Config|Mock $config;

    private Actions|Mock $actions;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->config = Mockery::mock(Config::class);
        $this->actions = Mockery::mock(Actions::class);
        $this->reverser = new Reverser($this->config, $this->actions);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->reverser);
        unset($this->config);
        unset($this->actions);
    }

    public function testReverse(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
