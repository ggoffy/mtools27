<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Actions;
use AutoRoute\Filter;
use AutoRoute\Generator;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

/**
 * Class GeneratorTest.
 *
 * @covers \AutoRoute\Generator
 */
final class GeneratorTest extends TestCase
{
    private Generator $generator;

    private Actions|Mock $actions;

    private Filter|Mock $filter;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->actions = Mockery::mock(Actions::class);
        $this->filter = Mockery::mock(Filter::class);
        $this->generator = new Generator($this->actions, $this->filter);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->generator);
        unset($this->actions);
        unset($this->filter);
    }

    public function testGenerate(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
