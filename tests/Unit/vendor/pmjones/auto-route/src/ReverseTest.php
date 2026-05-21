<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Reverse;
use PHPUnit\Framework\TestCase;

/**
 * Class ReverseTest.
 *
 * @covers \AutoRoute\Reverse
 */
final class ReverseTest extends TestCase
{
    private Reverse $reverse;

    private string $class;

    private string $verb;

    private string $path;

    private array $parameters;

    private int $requiredParametersTotal;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->class = '42';
        $this->verb = '42';
        $this->path = '42';
        $this->parameters = [];
        $this->requiredParametersTotal = 42;
        $this->reverse = new Reverse($this->class, $this->verb, $this->path, $this->parameters, $this->requiredParametersTotal);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->reverse);
        unset($this->class);
        unset($this->verb);
        unset($this->path);
        unset($this->parameters);
        unset($this->requiredParametersTotal);
    }

    public function test__get(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
