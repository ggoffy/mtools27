# mTools Shared Helper Usage

This document is the quick reference for helpers that consumer modules may use.
For a full migration walkthrough, see
[`CONVERTING-A-MODULE-WITH-MTOOLS.md`](CONVERTING-A-MODULE-WITH-MTOOLS.md).

## Runtime Bootstrap

Consumer modules should load:

```php
require_once XOOPS_ROOT_PATH . '/modules/mtools/bootstrap.php';
```

The bootstrap registers the `XoopsModules\Mtools\...` namespace and exposes:

```php
\XoopsModules\Mtools\Bootstrap::checkRuntime('1.0.0', '1.1.0');
```

Use this in install hooks, update hooks, admin bootstrap files, block files, CLI
scripts, and tests. Do not require files from `mtools/preloads/` directly.

## Stable Shared API

The stable shared API is under:

```php
XoopsModules\Mtools\Common
```

Only these classes are intended for normal consumer use.

### SysUtility

Purpose: shared XOOPS utility methods, including local XOOPS/PHP requirement
checks and filesystem setup helpers.

Typical consumer adapter:

```php
namespace XoopsModules\Quotes;

use XoopsModules\Mtools;

class Utility extends Mtools\Common\SysUtility
{
}
```

Use from install/update hooks:

```php
$utility = new \XoopsModules\Quotes\Utility();
$xoopsOk = $utility::checkVerXoops($module);
$phpOk   = $utility::checkVerPhp($module);
```

Stable since: `1.0.0`

XMF target: candidate after more consumer coverage.

### Configurator

Purpose: load module-local `config/config.php`, `config/icons.php`, and
`config/paths.php` into a typed shared object.

Example:

```php
$configurator = new \XoopsModules\Mtools\Common\Configurator($helper->path());

foreach ($configurator->uploadFolders as $folder) {
    $utility::prepareFolder($folder);
}
```

The consumer module still owns the config files; mTools only provides the
reader contract.

Stable since: `1.0.0`

### VersionChecks

Purpose: pure local XOOPS/PHP requirement checks.

Remote GitHub release polling is intentionally not part of this trait. Use
`UpdateChecker` explicitly if a module needs optional remote update checks.

Stable since: `1.0.0`

### UpdateChecker

Purpose: optional remote module update checks against GitHub releases.

This class performs network I/O. Do not call it from foundational install or
page-bootstrap paths.

Stable since: `1.0.0`

### Breadcrumb

Purpose: render a simple breadcrumb using a consumer-provided module context.

Pass the consumer dirname or template explicitly:

```php
$breadcrumb = new \XoopsModules\Mtools\Common\Breadcrumb('quotes', 'quotes_common_breadcrumb.tpl');
```

Do not rely on the helper guessing the consumer module.

Stable since: `1.0.0`

### DirectoryChecker and FileChecker

Purpose: check and manage known module filesystem paths.

State-changing methods require containment under a known base path or an
explicit allowed base path. Defaults are conservative: directories `0755`,
files `0644`.

```php
\XoopsModules\Mtools\Common\DirectoryChecker::createDirectory($target, 0755, $allowedBasePath);
\XoopsModules\Mtools\Common\FileChecker::copyFile($source, $target, $allowedBasePath);
```

Do not feed raw browser-posted paths into these helpers.

Stable since: `1.0.0`

### Blocksadmin

Purpose: shared legacy block-admin rendering and saving behavior.

This helper still contains UI-era behavior and should be used carefully. It is
stable for legacy consumers, but it is not a model for new library-style helper
design.

Stable since: `1.0.0`

### ModuleFeedback, ModuleStats, LetterChoice, ObjectTree, ServerStats, Migrate, TestdataButtons, TestdataSample, FilesManagement

Purpose: legacy helper support for existing modules.

These helpers are available under `Common\...`, but each should be adopted only
after checking that it fits the consumer module and does not pull UI or request
behavior into library code unnecessarily.

Stable since: `1.0.0`

## Experimental API

Experimental helpers live under:

```php
XoopsModules\Mtools\Lab
```

Current Lab classes:

- `DataMapperInterface`
- `IdentityMap`
- `IdentityMapInterface`
- `IdentityMapTrait`
- `Repository`
- `RepositoryInterface`

Do not use these in broad module migrations yet. They need real consumer
coverage and tests before they can graduate to `Common`.

## Consumer Rule of Thumb

Use mTools for shared infrastructure. Keep module behavior in the module.

Good mTools candidates:

- dependency checks
- install/update support
- generic config loading
- generic local version checks
- safe filesystem setup helpers

Keep local:

- object and handler classes
- SQL schema
- admin controllers
- public controllers
- templates and block templates
- CSS and JavaScript
- module-specific business rules

