<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Config;
use AutoRoute\Reflector;
use Mockery;
use Mockery\Mock;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class ReflectorTest.
 *
 * @covers \AutoRoute\Reflector
 */
final class ReflectorTest extends TestCase
{
    private Reflector $reflector;

    private Config|Mock $config;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->config = Mockery::mock(Config::class);
        $this->reflector = new Reflector($this->config);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->reflector);
        unset($this->config);
    }

    public function testGetConstructorParameters(): void
    {
        $expected = [];
        $property = (new ReflectionClass(Reflector::class))
            ->getProperty('constructorParameters');
        $property->setAccessible(true);
        $property->setValue($this->reflector, $expected);
        $this->assertSame($expected, $this->reflector->getConstructorParameters());
    }

    public function testGetActionParameters(): void
    {
        $expected = [];
        $property = (new ReflectionClass(Reflector::class))
            ->getProperty('actionParameters');
        $property->setAccessible(true);
        $property->setValue($this->reflector, $expected);
        $this->assertSame($expected, $this->reflector->getActionParameters());
    }

    public function testGetParameterType(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
