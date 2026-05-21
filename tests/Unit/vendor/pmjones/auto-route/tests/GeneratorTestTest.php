<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\GeneratorTest;
use PHPUnit\Framework\TestCase;

/**
 * Class GeneratorTestTest.
 *
 * @covers \AutoRoute\GeneratorTest
 */
final class GeneratorTestTest extends TestCase
{
    private GeneratorTest $generatorTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->generatorTest = new GeneratorTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->generatorTest);
    }

    public function testTestGenerate(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGenerateInvalidNamespace(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGenerateNoSuchClass(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGenerateTooManySegments(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGenerateNotEnoughSegments(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGenerate_noBaseUrl(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
