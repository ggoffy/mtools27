<?php

namespace Tests\Unit\AutoRoute\Http;

use AutoRoute\Http\Get;
use PHPUnit\Framework\TestCase;

/**
 * Class GetTest.
 *
 * @covers \AutoRoute\Http\Get
 */
final class GetTest extends TestCase
{
    private Get $get;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->get = new Get();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->get);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
