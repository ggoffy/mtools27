<?php declare(strict_types=1);

class MtoolsCorePreload extends \XoopsPreloadItem
{
    public static function eventCoreFooterStart($args): void
    {
        // Shared-helper consumers must not inherit UI assets, session writes, or
        // database writes just because mtools is installed. Theme/bootstrap
        // behavior belongs behind an explicit opt-in service.
    }

    // to add PSR-4 autoloader

    /**
     * @param $args
     */
    public static function eventCoreIncludeCommonEnd(array $args): void
    {
        require \dirname(__DIR__) . '/bootstrap.php';
    }
}
