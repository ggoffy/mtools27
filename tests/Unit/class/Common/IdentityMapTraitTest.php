<?php

namespace Tests\Unit;

use IdentityMapTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class IdentityMapTraitTest.
 *
 * @covers \IdentityMapTrait
 */
final class IdentityMapTraitTest extends TestCase
{
    private IdentityMapTrait $identityMapTrait;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->identityMapTrait = $this->getMockBuilder(IdentityMapTrait::class)
            ->setConstructorArgs([])
            ->getMockForTrait();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->identityMapTrait);
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
