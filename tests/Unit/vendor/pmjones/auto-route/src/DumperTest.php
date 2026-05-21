<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Actions;
use AutoRoute\Config;
use AutoRoute\Dumper;
use AutoRoute\Reflector;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

/**
 * Class DumperTest.
 *
 * @covers \AutoRoute\Dumper
 */
final class DumperTest extends TestCase
{
    private Dumper $dumper;

    private Config|Mock $config;

    private Reflector|Mock $reflector;

    private Actions|Mock $actions;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->config = Mockery::mock(Config::class);
        $this->reflector = Mockery::mock(Reflector::class);
        $this->actions = Mockery::mock(Actions::class);
        $this->dumper = new Dumper($this->config, $this->reflector, $this->actions);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->dumper);
        unset($this->config);
        unset($this->reflector);
        unset($this->actions);
    }

    public function testDump(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
