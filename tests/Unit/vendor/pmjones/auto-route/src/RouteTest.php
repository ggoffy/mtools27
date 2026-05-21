<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Route;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use Throwable;

/**
 * Class RouteTest.
 *
 * @covers \AutoRoute\Route
 */
final class RouteTest extends TestCase
{
    private Route $route;

    private string $class;

    private string $method;

    private array $arguments;

    private string $error;

    private Throwable|Mock $exception;

    private array $headers;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->class = '42';
        $this->method = '42';
        $this->arguments = [];
        $this->error = '42';
        $this->exception = Mockery::mock(Throwable::class);
        $this->headers = [];
        $this->route = new Route($this->class, $this->method, $this->arguments, $this->error, $this->exception, $this->headers);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->route);
        unset($this->class);
        unset($this->method);
        unset($this->arguments);
        unset($this->error);
        unset($this->exception);
        unset($this->headers);
    }

    public function test__get(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
