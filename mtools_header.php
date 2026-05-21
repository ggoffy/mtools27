<?php declare(strict_types=1);

if (!defined('XOOPS_ROOT_PATH')) {
    require_once \dirname(__DIR__, 2) . '/mainfile.php';
} else {
    require_once XOOPS_ROOT_PATH . '/mainfile.php';
}
$moduleDirName = basename(__DIR__);

if (!defined('MTOOLS_PATH')) {
    define('MTOOLS_PATH', XOOPS_ROOT_PATH . '/modules/mtools');
}

if (!defined('MTOOLS_URL')) {
    define('MTOOLS_URL', XOOPS_URL . '/modules/mtools');
}

require __DIR__ . '/bootstrap.php';

if (!defined('MTOOLS_VERSION')) {
    define('MTOOLS_VERSION', \XoopsModules\Mtools\Bootstrap::MIN_MODULE_VERSION);
}

xoops_loadLanguage('main', $moduleDirName);
