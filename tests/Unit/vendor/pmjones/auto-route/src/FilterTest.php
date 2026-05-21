<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Filter;
use AutoRoute\Reflector;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

/**
 * Class FilterTest.
 *
 * @covers \AutoRoute\Filter
 */
final class FilterTest extends TestCase
{
    private Filter $filter;

    private Reflector|Mock $reflector;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->reflector = Mockery::mock(Reflector::class);
        $this->filter = new Filter($this->reflector);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->filter);
        unset($this->reflector);
    }

    public function testParameter(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
