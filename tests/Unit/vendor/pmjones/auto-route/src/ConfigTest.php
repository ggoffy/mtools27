<?php

namespace Tests\Unit\AutoRoute;

use AutoRoute\Config;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigTest.
 *
 * @covers \AutoRoute\Config
 */
final class ConfigTest extends TestCase
{
    private Config $config;

    private string $namespace;

    private string $directory;

    private string $baseUrl;

    private int $ignoreParams;

    private string $method;

    private string $suffix;

    private string $wordSeparator;

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
        $this->config = new Config($this->namespace, $this->directory, $this->baseUrl, $this->ignoreParams, $this->method, $this->suffix, $this->wordSeparator);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->config);
        unset($this->namespace);
        unset($this->directory);
        unset($this->baseUrl);
        unset($this->ignoreParams);
        unset($this->method);
        unset($this->suffix);
        unset($this->wordSeparator);
    }

    public function test__get(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
