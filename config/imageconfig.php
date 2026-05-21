<?php declare(strict_types=1);

$moduleDirName      = \basename(\dirname(__DIR__));
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

// extra module configs
$modversion['config'][] = [
    'name'        => 'imageConfigs',
    'title'       => '_CO_MTOOLS_IMAGE_CONFIG',
    'description' => '_CO_MTOOLS_IMAGE_CONFIG_DSC',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head',
];

$modversion['config'][] = [
    'name'        => 'imageWidth',
    'title'       => '_CO_MTOOLS_IMAGE_WIDTH',
    'description' => '_CO_MTOOLS_IMAGE_WIDTH_DSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 1200,
]; // =1024/16

$modversion['config'][] = [
    'name'        => 'imageHeight',
    'title'       => '_CO_MTOOLS_IMAGE_HEIGHT',
    'description' => '_CO_MTOOLS_IMAGE_HEIGHT_DSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 800,
]; // =768/16

$modversion['config'][] = [
    'name'        => 'imageFilesize',
    'title'       => '_CO_MTOOLS_IMAGE_FILE_SIZE',
    'description' => '_CO_MTOOLS_IMAGE_FILE_SIZE_DSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 2000000,
]; // =768/16

$modversion['config'][] = [
    'name'        => 'imageUploadPath',
    'title'       => '_CO_MTOOLS_IMAGE_UPLOAD_PATH',
    'description' => '_CO_MTOOLS_IMAGE_UPLOAD_PATH_DSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'uploads/' . $modversion['dirname'] . '/images',
];
