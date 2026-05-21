<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Actions;
use AutoRoute\AutoRoute;
use AutoRoute\Config;
use AutoRoute\Creator;
use AutoRoute\Dumper;
use AutoRoute\Filter;
use AutoRoute\Generator;
use AutoRoute\Reflector;
use AutoRoute\Router;
use Mockery;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class AutoRouteTest.
 *
 * @covers \AutoRoute\AutoRoute
 */
final class AutoRouteTest extends TestCase
{
    private AutoRoute $autoRoute;

    private string $namespace;

    private string $directory;

    private string $baseUrl;

    private int $ignoreParams;

    private string $method;

    private string $suffix;

    private string $wordSeparator;

    private mixed $loggerFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->namespace = '42';
        $this->directory = '42';
        $this->baseUrl = '42';
        $this->ignoreParams = 42;
        $this->method = '42';
        $this->suffix = '42';
        $this->wordSeparator = '42';
        $this->loggerFactory = null;
        $this->autoRoute = new AutoRoute($this->namespace, $this->directory, $this->baseUrl, $this->ignoreParams, $this->method, $this->suffix, $this->wordSeparator, $this->loggerFactory);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->autoRoute);
        unset($this->namespace);
        unset($this->directory);
        unset($this->baseUrl);
        unset($this->ignoreParams);
        unset($this->method);
        unset($this->suffix);
        unset($this->wordSeparator);
        unset($this->loggerFactory);
    }

    public function testGetActions(): void
    {
        $expected = Mockery::mock(Actions::class);
        $property = (new ReflectionClass(AutoRoute::class))
            ->getProperty('actions');
        $property->setAccessible(true);
        $property->setValue($this->autoRoute, $expected);
        $this->assertSame($expected, $this->autoRoute->getActions());
    }

    public function testGetConfig(): void
    {
        $expected = Mockery::mock(Config::class);
        $property = (new ReflectionClass(AutoRoute::class))
            ->getProperty('config');
        $property->setAccessible(true);
        $property->setValue($this->autoRoute, $expected);
        $this->assertSame($expected, $this->autoRoute->getConfig());
    }

    public function testGetCreator(): void
    {
        $expected = Mockery::mock(Creator::class);
        $property = (new ReflectionClass(AutoRoute::class))
            ->getProperty('creator');
        $property->setAccessible(true);
        $property->setValue($this->autoRoute, $expected);
        $this->assertSame($expected, $this->autoRoute->getCreator());
    }

    public function testGetDumper(): void
    {
        $expected = Mockery::mock(Dumper::class);
        $property = (new ReflectionClass(AutoRoute::class))
            ->getProperty('dumper');
        $property->setAccessible(true);
        $property->setValue($this->autoRoute, $expected);
        $this->assertSame($expected, $this->autoRoute->getDumper());
    }

    public function testGetFilter(): void
    {
        $expected = Mockery::mock(Filter::class);
        $property = (new ReflectionClass(AutoRoute::class))
            ->getProperty('filter');
        $property->setAccessible(true);
        $property->setValue($this->autoRoute, $expected);
        $this->assertSame($expected, $this->autoRoute->getFilter());
    }

    public function testGetGenerator(): void
    {
        $expected = Mockery::mock(Generator::class);
        $property = (new ReflectionClass(AutoRoute::class))
            ->getProperty('generator');
        $property->setAccessible(true);
        $property->setValue($this->autoRoute, $expected);
        $this->assertSame($expected, $this->autoRoute->getGenerator());
    }

    public function testGetLogger(): void
    {
        $expected = Mockery::mock(LoggerInterface::class);
        $property = (new ReflectionClass(AutoRoute::class))
            ->getProperty('logger');
        $property->setAccessible(true);
        $property->setValue($this->autoRoute, $expected);
        $this->assertSame($expected, $this->autoRoute->getLogger());
    }

    public function testGetReflector(): void
    {
        $expected = Mockery::mock(Reflector::class);
        $property = (new ReflectionClass(AutoRoute::class))
            ->getProperty('reflector');
        $property->setAccessible(true);
        $property->setValue($this->autoRoute, $expected);
        $this->assertSame($expected, $this->autoRoute->getReflector());
    }

    public function testGetRouter(): void
    {
        $expected = Mockery::mock(Router::class);
        $property = (new ReflectionClass(AutoRoute::class))
            ->getProperty('router');
        $property->setAccessible(true);
        $property->setValue($this->autoRoute, $expected);
        $this->assertSame($expected, $this->autoRoute->getRouter());
    }
}
