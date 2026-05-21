<?php

namespace Tests\Unit;

use IdentityMap;
use PHPUnit\Framework\TestCase;

/**
 * Class IdentityMapTest.
 *
 * @covers \IdentityMap
 */
final class IdentityMapTest extends TestCase
{
    private IdentityMap $identityMap;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->identityMap = new IdentityMap();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->identityMap);
    }

    public function testSet(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetId(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testHasId(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testHasObject(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetObject(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
