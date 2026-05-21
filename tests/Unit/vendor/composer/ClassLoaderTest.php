<?php

namespace Tests\Unit\Composer\Autoload;

use Composer\Autoload\ClassLoader;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class ClassLoaderTest.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jordi Boggiano <j.boggiano@seld.be>
 *
 * @covers \Composer\Autoload\ClassLoader
 */
final class ClassLoaderTest extends TestCase
{
    private ClassLoader $classLoader;

    private mixed $vendorDir;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->vendorDir = null;
        $this->classLoader = new ClassLoader($this->vendorDir);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->classLoader);
        unset($this->vendorDir);
    }

    public function testGetPrefixes(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetPrefixesPsr4(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetFallbackDirs(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetFallbackDirsPsr4(): void
    {
        $expected = null;
        $property = (new ReflectionClass(ClassLoader::class))
            ->getProperty('fallbackDirsPsr4');
        $property->setAccessible(true);
        $property->setValue($this->classLoader, $expected);
        $this->assertSame($expected, $this->classLoader->getFallbackDirsPsr4());
    }

    public function testGetClassMap(): void
    {
        $expected = null;
        $property = (new ReflectionClass(ClassLoader::class))
            ->getProperty('classMap');
        $property->setAccessible(true);
        $property->setValue($this->classLoader, $expected);
        $this->assertSame($expected, $this->classLoader->getClassMap());
    }

    public function testAddClassMap(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testAdd(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testAddPsr4(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSet(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetPsr4(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetUseIncludePath(): void
    {
        $expected = true;
        $property = (new ReflectionClass(ClassLoader::class))
            ->getProperty('useIncludePath');
        $property->setAccessible(true);
        $this->classLoader->setUseIncludePath($expected);
        $this->assertSame($expected, $property->getValue($this->classLoader));
    }

    public function testGetUseIncludePath(): void
    {
        $expected = true;
        $property = (new ReflectionClass(ClassLoader::class))
            ->getProperty('useIncludePath');
        $property->setAccessible(true);
        $property->setValue($this->classLoader, $expected);
        $this->assertSame($expected, $this->classLoader->getUseIncludePath());
    }

    public function testSetClassMapAuthoritative(): void
    {
        $expected = true;
        $property = (new ReflectionClass(ClassLoader::class))
            ->getProperty('classMapAuthoritative');
        $property->setAccessible(true);
        $this->classLoader->setClassMapAuthoritative($expected);
        $this->assertSame($expected, $property->getValue($this->classLoader));
    }

    public function testIsClassMapAuthoritative(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetApcuPrefix(): void
    {
        $expected = '42';
        $property = (new ReflectionClass(ClassLoader::class))
            ->getProperty('apcuPrefix');
        $property->setAccessible(true);
        $this->classLoader->setApcuPrefix($expected);
        $this->assertSame($expected, $property->getValue($this->classLoader));
    }

    public function testGetApcuPrefix(): void
    {
        $expected = '42';
        $property = (new ReflectionClass(ClassLoader::class))
            ->getProperty('apcuPrefix');
        $property->setAccessible(true);
        $property->setValue($this->classLoader, $expected);
        $this->assertSame($expected, $this->classLoader->getApcuPrefix());
    }

    public function testRegister(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testUnregister(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testLoadClass(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testFindFile(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetRegisteredLoaders(): void
    {
        $expected = [];
        $property = (new ReflectionClass(ClassLoader::class))
            ->getProperty('registeredLoaders');
        $property->setAccessible(true);
        $property->setValue(null, $expected);
        $this->assertSame($expected, ClassLoader::getRegisteredLoaders());
    }
}
