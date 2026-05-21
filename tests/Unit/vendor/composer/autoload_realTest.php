<?php

namespace Tests\Unit;

use ComposerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8;
use Composer\Autoload\ClassLoader;
use Mockery;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class ComposerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8Test.
 *
 * @covers \ComposerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8
 */
final class ComposerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8Test extends TestCase
{
    private ComposerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8 $composerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->composerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8 = new ComposerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->composerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8);
    }

    public function testLoadClassLoader(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetLoader(): void
    {
        $expected = Mockery::mock(ClassLoader::class);
        $property = (new ReflectionClass(ComposerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8::class))
            ->getProperty('loader');
        $property->setAccessible(true);
        $property->setValue(null, $expected);
        $this->assertSame($expected, ComposerAutoloaderInit5b362e8ee66e479c1f424e17841f03b8::getLoader());
    }
}
