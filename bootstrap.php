<?php declare(strict_types=1);

/**
 * Public, side-effect-free bootstrap for modules that consume mtools helpers.
 *
 * This file registers the mtools namespace and exposes the API version contract.
 * It must not load XOOPS mainfile, inject assets, redirect, write to the
 * database, or depend on preload execution order.
 */

if (!defined('MTOOLS_PATH')) {
    define('MTOOLS_PATH', __DIR__);
}

if (defined('XOOPS_URL') && !defined('MTOOLS_URL')) {
    define('MTOOLS_URL', XOOPS_URL . '/modules/mtools');
}

require_once __DIR__ . '/preloads/autoloader.php';

if (!defined('MTOOLS_API_VERSION')) {
    define('MTOOLS_API_VERSION', \XoopsModules\Mtools\Bootstrap::API_VERSION);
}

