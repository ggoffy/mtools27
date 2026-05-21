<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Actions;
use AutoRoute\Config;
use AutoRoute\Filter;
use AutoRoute\Router;
use Mockery;
use Mockery\Mock;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class RouterTest.
 *
 * @covers \AutoRoute\Router
 */
final class RouterTest extends TestCase
{
    private Router $router;

    private Config|Mock $config;

    private Actions|Mock $actions;

    private Filter|Mock $filter;

    private LoggerInterface|Mock $logger;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->config = Mockery::mock(Config::class);
        $this->actions = Mockery::mock(Actions::class);
        $this->filter = Mockery::mock(Filter::class);
        $this->logger = Mockery::mock(LoggerInterface::class);
        $this->router = new Router($this->config, $this->actions, $this->filter, $this->logger);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->router);
        unset($this->config);
        unset($this->actions);
        unset($this->filter);
        unset($this->logger);
    }

    public function testGetLogger(): void
    {
        $expected = Mockery::mock(LoggerInterface::class);
        $property = (new ReflectionClass(Router::class))
            ->getProperty('logger');
        $property->setAccessible(true);
        $property->setValue($this->router, $expected);
        $this->assertSame($expected, $this->router->getLogger());
    }

    public function testRoute(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
