<?php

namespace Tests\Unit\AutoRoute\Value;

use AutoRoute\Value\Id;
use PHPUnit\Framework\TestCase;

/**
 * Class IdTest.
 *
 * @covers \AutoRoute\Value\Id
 */
final class IdTest extends TestCase
{
    private Id $id;

    private int $id;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->id = 42;
        $this->id = new Id($this->id);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->id);
        unset($this->id);
    }

    public function testGet(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
