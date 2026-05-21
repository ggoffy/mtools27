<?php declare(strict_types=1);

namespace XoopsModules\Mtools;

use XoopsModules\Mtools\Module\Dependency;

/**
 * Stable runtime contract for modules consuming mtools as a shared helper layer.
 */
final class Bootstrap
{
    public const API_VERSION = '1.0.0';
    public const MIN_MODULE_VERSION = '1.1.0';
    public const MODULE_DIRNAME = 'mtools';

    public static function apiVersion(): string
    {
        return self::API_VERSION;
    }

    /**
     * @return array{ok: bool, errors: list<string>, module_version: string|null, api_version: string}
     */
    public static function checkRuntime(
        string $minimumApiVersion = self::API_VERSION,
        string $minimumModuleVersion = self::MIN_MODULE_VERSION
    ): array {
        $errors = [];

        $moduleStatus = Dependency::checkModule(self::MODULE_DIRNAME, $minimumModuleVersion);
        $errors = $moduleStatus['errors'];
        $moduleVersion = $moduleStatus['module_version'];

        if (version_compare(self::API_VERSION, self::normalizeVersion($minimumApiVersion), '<')) {
            $errors[] = sprintf(
                'mtools API %s is required; API %s is available.',
                $minimumApiVersion,
                self::API_VERSION
            );
        }

        return self::status($errors, $moduleVersion);
    }

    public static function assertRuntime(
        string $minimumApiVersion = self::API_VERSION,
        string $minimumModuleVersion = self::MIN_MODULE_VERSION
    ): void {
        $status = self::checkRuntime($minimumApiVersion, $minimumModuleVersion);

        if (!$status['ok']) {
            throw new \RuntimeException(implode(' ', $status['errors']));
        }
    }

    public static function statusMessage(array $status): string
    {
        return implode(' ', $status['errors'] ?? []);
    }

    /**
     * @param list<string> $errors
     *
     * @return array{ok: bool, errors: list<string>, module_version: string|null, api_version: string}
     */
    private static function status(array $errors, ?string $moduleVersion): array
    {
        return [
            'ok'             => [] === $errors,
            'errors'         => $errors,
            'module_version' => $moduleVersion,
            'api_version'    => self::API_VERSION,
        ];
    }

    private static function normalizeVersion(string $version): string
    {
        $version = trim($version);

        if ('' === $version) {
            return '0.0.0';
        }

        if (preg_match('/^\d+$/', $version) === 1 && (int)$version >= 100) {
            return number_format(((int)$version) / 100, 2, '.', '');
        }

        return preg_replace('/-(alpha|beta|rc)\d*/i', '', $version) ?? $version;
    }
}
