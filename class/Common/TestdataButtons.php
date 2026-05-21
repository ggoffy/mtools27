<?php declare(strict_types=1);

namespace XoopsModules\Mtools\Common;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * @category        Module
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       2000-2026 XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */

use Xmf\Yaml;
use XoopsModules\Mtools\Helper;

/** @var Helper $helper */

/**
 * Class TestdataButtons
 */
class TestdataButtons
{
    /** Button status constants */
    private const SHOW_BUTTONS = 1;
    private const HIDE_BUTTONS = 0;

    /**
     * Load the test button configuration
     *
     * @param \Xmf\Module\Admin $adminObject
     *
     * @return void
     */
    public static function loadButtonConfig($adminObject, ?\Xmf\Module\Helper $helper = null): void
    {
        $helper             = $helper ?? Helper::getInstance();
        $moduleDirName      = $helper->getDirname();
        $moduleDirNameUpper = \mb_strtoupper($moduleDirName);
        $yamlFile            = $helper->path('/config/admin.yml');
        /** @var array $config */
        $config              = Yaml::readWrapped($yamlFile); // work with phpmyadmin YAML dumps
        $displaySampleButton = $config['displaySampleButton'];

        if (self::SHOW_BUTTONS == $displaySampleButton) {
            \xoops_loadLanguage('admin/modulesadmin', 'system');
            $adminObject->addItemButton(\constant('_CO_MTOOLS_LOAD_SAMPLEDATA'), $helper->url('testdata/index.php?op=load'), 'add');
            $adminObject->addItemButton(\constant('_CO_MTOOLS_SAVE_SAMPLEDATA'), $helper->url('testdata/index.php?op=save'), 'add');
            $adminObject->addItemButton(\constant('_CO_MTOOLS_CLEAR_SAMPLEDATA'), $helper->url('testdata/index.php?op=clear'), 'alert');
            //    $adminObject->addItemButton(constant('_CO_MTOOLS_EXPORT_SCHEMA'), $helper->url( 'testdata/index.php?op=exportschema'), 'add');
            $adminObject->addItemButton(\constant('_CO_MTOOLS_HIDE_SAMPLEDATA_BUTTONS'), '?op=hide_buttons', 'delete');
        } else {
            $adminObject->addItemButton(\constant('_CO_MTOOLS_SHOW_SAMPLEDATA_BUTTONS'), '?op=show_buttons', 'add');
            // $displaySampleButton = $config['displaySampleButton'];
        }
    }

    //$modhelper->url('admin/index.php?op=show_buttons')

    public static function hideButtons($modhelper): void
    {
        $yamlFile                   = $modhelper->path('config/admin.yml');
        $app                        = [];
        $app['displaySampleButton'] = 0;
        Yaml::save($app, $yamlFile);
        \redirect_header($modhelper->url('admin/index.php'), 0, '');
    }

    public static function showButtons($modhelper): void
    {
        $yamlFile                   = $modhelper->path('config/admin.yml');
        $app                        = [];
        $app['displaySampleButton'] = 1;
        Yaml::save($app, $yamlFile);
        \redirect_header($modhelper->url('admin/index.php'), 0, '');
    }
}
