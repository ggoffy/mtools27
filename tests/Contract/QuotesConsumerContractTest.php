<?php declare(strict_types=1);

namespace XoopsModules\Mtools\Tests\Contract;

use PHPUnit\Framework\TestCase;
use XoopsModules\Mtools\Bootstrap;
use XoopsModules\Mtools\Common\SysUtility;
use XoopsModules\Quotes\Utility;

final class QuotesConsumerContractTest extends TestCase
{
    public function testQuotesBootstrapLoadsMtoolsPublicApi(): void
    {
        require_once dirname(__DIR__, 3) . '/quotes/bootstrap.php';

        self::assertTrue(class_exists(Bootstrap::class));
        self::assertTrue(class_exists(SysUtility::class));
    }

    public function testQuotesUtilityExtendsMtoolsSysUtility(): void
    {
        require_once dirname(__DIR__, 3) . '/quotes/bootstrap.php';

        self::assertTrue(is_subclass_of(Utility::class, SysUtility::class));
    }

    public function testMtoolsRuntimeReportsClearFailureWithoutXoopsBootstrap(): void
    {
        require_once dirname(__DIR__, 2) . '/bootstrap.php';

        $status = Bootstrap::checkRuntime();

        self::assertFalse($status['ok']);
        self::assertNotSame('', Bootstrap::statusMessage($status));
    }
}

