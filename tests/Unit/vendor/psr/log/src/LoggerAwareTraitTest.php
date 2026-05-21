<?php

namespace Tests\Unit\Psr\Log;

use Mockery;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class LoggerAwareTraitTest.
 *
 * @covers \Psr\Log\LoggerAwareTrait
 */
final class LoggerAwareTraitTest extends TestCase
{
    private LoggerAwareTrait $loggerAwareTrait;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->loggerAwareTrait = $this->getMockBuilder(LoggerAwareTrait::class)
            ->setConstructorArgs([])
            ->getMockForTrait();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->loggerAwareTrait);
    }

    public function testSetLogger(): void
    {
        $expected = Mockery::mock(LoggerInterface::class);
        $property = (new ReflectionClass(LoggerAwareTrait::class))
            ->getProperty('logger');
        $property->setAccessible(true);
        $this->loggerAwareTrait->setLogger($expected);
        $this->assertSame($expected, $property->getValue($this->loggerAwareTrait));
    }
}
