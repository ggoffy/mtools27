<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Actions;
use AutoRoute\Config;
use AutoRoute\Reflector;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

/**
 * Class ActionsTest.
 *
 * @covers \AutoRoute\Actions
 */
final class ActionsTest extends TestCase
{
    private Actions $actions;

    private Config|Mock $config;

    private Reflector|Mock $reflector;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->config = Mockery::mock(Config::class);
        $this->reflector = Mockery::mock(Reflector::class);
        $this->actions = new Actions($this->config, $this->reflector);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->actions);
        unset($this->config);
        unset($this->reflector);
    }

    public function testGetAction(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetReverse(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetClass(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testHasAction(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testHasSubNamespace(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetAllowed(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetClasses(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
