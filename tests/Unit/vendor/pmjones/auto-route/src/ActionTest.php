<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Action;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class ActionTest.
 *
 * @covers \AutoRoute\Action
 */
final class ActionTest extends TestCase
{
    private Action $action;

    private string $class;

    private array $requiredParameters;

    private array $optionalParameters;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->class = '42';
        $this->requiredParameters = [];
        $this->optionalParameters = [];
        $this->action = new Action($this->class, $this->requiredParameters, $this->optionalParameters);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->action);
        unset($this->class);
        unset($this->requiredParameters);
        unset($this->optionalParameters);
    }

    public function testGetClass(): void
    {
        $expected = '42';
        $property = (new ReflectionClass(Action::class))
            ->getProperty('class');
        $property->setAccessible(true);
        $property->setValue($this->action, $expected);
        $this->assertSame($expected, $this->action->getClass());
    }

    public function testGetRequiredParameters(): void
    {
        $expected = [];
        $property = (new ReflectionClass(Action::class))
            ->getProperty('requiredParameters');
        $property->setAccessible(true);
        $property->setValue($this->action, $expected);
        $this->assertSame($expected, $this->action->getRequiredParameters());
    }

    public function testGetOptionalParameters(): void
    {
        $expected = [];
        $property = (new ReflectionClass(Action::class))
            ->getProperty('optionalParameters');
        $property->setAccessible(true);
        $property->setValue($this->action, $expected);
        $this->assertSame($expected, $this->action->getOptionalParameters());
    }
}
