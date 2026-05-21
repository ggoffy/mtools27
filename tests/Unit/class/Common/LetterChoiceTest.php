<?php

namespace Tests\Unit\XoopsModules\Quotes\Common;


use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use XoopsModules\Quotes\Common\LetterChoice;
use XoopsPersistableObjectHandler;

/**
 * Class LetterChoiceTest.
 *
 * @covers \XoopsModules\Quotes\Common\LetterChoice
 */
final class LetterChoiceTest extends TestCase
{
    private LetterChoice $letterChoice;

    private |Mock $modHelper;

    private XoopsPersistableObjectHandler|Mock $objHandler;

    private mixed $criteria;

    private mixed $field_name;

    private array $alphabet;

    private string $arg_name;

    private mixed $url;

    private string $extra_arg;

    private bool $caseSensitive;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->modHelper = Mockery::mock(::class);
        $this->objHandler = Mockery::mock(XoopsPersistableObjectHandler::class);
        $this->criteria = null;
        $this->field_name = null;
        $this->alphabet = [];
        $this->arg_name = '42';
        $this->url = null;
        $this->extra_arg = '42';
        $this->caseSensitive = true;
        $this->letterChoice = new LetterChoice($this->modHelper, $this->objHandler, $this->criteria, $this->field_name, $this->alphabet, $this->arg_name, $this->url, $this->extra_arg, $this->caseSensitive);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->letterChoice);
        unset($this->modHelper);
        unset($this->objHandler);
        unset($this->criteria);
        unset($this->field_name);
        unset($this->alphabet);
        unset($this->arg_name);
        unset($this->url);
        unset($this->extra_arg);
        unset($this->caseSensitive);
    }

    public function testRender(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
