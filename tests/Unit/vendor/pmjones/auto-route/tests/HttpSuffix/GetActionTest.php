<?php

namespace Tests\Unit\AutoRoute\HttpSuffix;

use AutoRoute\HttpSuffix\GetAction;
use PHPUnit\Framework\TestCase;

/**
 * Class GetActionTest.
 *
 * @covers \AutoRoute\HttpSuffix\GetAction
 */
final class GetActionTest extends TestCase
{
    private GetAction $getAction;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->getAction = new GetAction();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->getAction);
    }

    public function test__invoke(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
