<?php declare(strict_types=1);

namespace XoopsModules\Mtools\Common;

/**
 * Optional remote update checks. Keep this separate from local version checks.
 */
final class UpdateChecker
{
    public static function checkVerModule(\Xmf\Module\Helper $helper, ?string $source = 'github', ?string $default = 'master'): ?array
    {
        $module = $helper->getModule();
        $moduleDirName = $module instanceof \XoopsModule
            ? basename((string)$module->getVar('dirname'))
            : basename(\dirname(__DIR__, 2));
        $moduleDirNameUpper = mb_strtoupper($moduleDirName);
        $repository         = 'XoopsModules25x/' . $moduleDirName;
        $ret                = null;

        if ('github' !== $source || !function_exists('curl_init')) {
            return null;
        }

        $infoReleasesUrl = "https://api.github.com/repos/$repository/releases";
        $curlHandle      = curl_init();
        if (false === $curlHandle) {
            return null;
        }

        curl_setopt($curlHandle, CURLOPT_URL, $infoReleasesUrl);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ['User-Agent: XOOPS mtools']);

        $curlReturn = curl_exec($curlHandle);
        if (false === $curlReturn) {
            trigger_error(curl_error($curlHandle));
            curl_close($curlHandle);

            return null;
        }

        curl_close($curlHandle);

        if (false !== mb_strpos((string)$curlReturn, 'Not Found')) {
            trigger_error('Repository Not Found: ' . $infoReleasesUrl);

            return null;
        }

        $releases = json_decode((string)$curlReturn, false);
        if (!is_array($releases) || [] === $releases || !isset($releases[0]->tag_name)) {
            return null;
        }

        $latestVersionLink = sprintf("https://github.com/$repository/archive/%s.zip", $releases ? reset($releases)->tag_name : $default);
        $latestVersion     = (string)$releases[0]->tag_name;
        $prerelease        = (bool)($releases[0]->prerelease ?? false);
        $updateLabel       = defined('_CO_MTOOLS_NEW_VERSION')
            ? constant('_CO_MTOOLS_NEW_VERSION')
            : 'New version: ';

        $normalizedLatest = self::normalizeVersion($latestVersion);
        $moduleVersion = $module instanceof \XoopsModule
            ? self::normalizeVersion($module->getInfo('version') . '_' . $module->getInfo('module_status'))
            : '0.0.0';

        if (!$prerelease && version_compare($moduleVersion, $normalizedLatest, '<')) {
            $ret   = [];
            $ret[] = $updateLabel . $latestVersion;
            $ret[] = $latestVersionLink;
        }

        return $ret;
    }

    private static function normalizeVersion(string $version): string
    {
        $version = str_replace(' ', '', mb_strtolower($version));

        if (false !== mb_strpos($version, 'final')) {
            $version = str_replace(['_', 'final'], '', $version);
        }

        return $version;
    }
}
