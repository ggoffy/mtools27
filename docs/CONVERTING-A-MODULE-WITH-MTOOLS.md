# Converting a XOOPS Module to Use mTools

This tutorial explains how to convert an existing XOOPS module so it uses
`mtools` as a shared helper layer instead of carrying a private
`class/Common/` copy. It uses the `quotes` module as the practical reference
implementation.

The goal is not to make every module depend on every mTools helper. The goal is
to move stable, reusable helper behavior into one shared module while each
consumer module keeps ownership of its own domain model, handlers, templates,
blocks, language files, and visual design.

## What mTools Owns

`mtools` is the shared-helper host. A consumer module may use:

- `XoopsModules\Mtools\Common\...` for stable shared helpers.
- `XoopsModules\Mtools\Bootstrap` for runtime dependency checks.
- `XoopsModules\Mtools\Module\Dependency` for lower-level module dependency
  checks.

Do not consume classes from `XoopsModules\Mtools\Lab\...` unless you accept an
experimental API. Do not extend module-local mTools classes unless they are
explicitly documented in `docs/architecture.md`.

## What the Consumer Module Still Owns

A converted module still owns:

- its own namespace, for example `XoopsModules\Quotes`
- its own `xoops_version.php`
- its own handlers and objects
- its own install/update/uninstall hooks
- its own admin pages
- its own templates and block templates
- its own CSS and UI decisions
- its own upload paths, SQL schema, and test data

In `quotes`, mTools provides shared helper behavior, but the quote/category/
author models, handlers, templates, blocks, and public UI remain in the Quotes
module.

## Before You Start

Pick one module and audit its local `class/Common/` folder.

Classify each local helper:

- **Shared helper**: generic XOOPS support logic that belongs in mTools.
- **Module-specific helper**: logic tied to this module's tables, templates, or
  workflows. Keep it in the module.
- **Unsafe helper**: code that reads `$_POST`, redirects, echoes output, writes
  files, or touches the database at file scope. Do not move this directly into
  mTools. Split it into a pure class plus a controller/admin endpoint first.

The best first migration is usually `Utility extends
Mtools\Common\SysUtility`, because it removes the old copied utility base
without changing the module's domain behavior.

## Step 1: Declare the Dependency in `xoops_version.php`

Add `mtools` to the consumer module manifest:

```php
$modversion = [
    // ...
    'min_modules' => ['mtools' => '1.1.0'],
    // ...
];
```

Quotes example:

```php
'min_modules' => ['mtools' => '1.1.0'],
```

This documents the dependency for XOOPS and for humans reading the module.
It is not enough by itself; install and runtime checks are still required.

## Step 2: Add a Module Bootstrap

Create a `bootstrap.php` file in the consumer module.

Quotes uses:

```php
<?php declare(strict_types=1);

require_once __DIR__ . '/preloads/autoloader.php';

if (defined('XOOPS_ROOT_PATH')) {
    $mtoolsBootstrap = XOOPS_ROOT_PATH . '/modules/mtools/bootstrap.php';
    if (is_file($mtoolsBootstrap)) {
        require_once $mtoolsBootstrap;
    }
}

require_once __DIR__ . '/include/mtools_dependency.php';
```

The important rules:

- The consumer registers its own namespace.
- The consumer loads the public mTools bootstrap.
- The consumer does not require `modules/mtools/preloads/autoloader.php`
  directly.
- Class files should not perform `require_once` side effects.

## Step 3: Add One Dependency Helper in the Consumer

Create `include/mtools_dependency.php` in the consumer module.

Quotes uses:

```php
<?php declare(strict_types=1);

use XoopsModules\Mtools;

if (!function_exists('quotes_mtools_dependency_error')) {
    function quotes_mtools_dependency_error(): string
    {
        if (!class_exists(Mtools\Bootstrap::class)) {
            return 'The mtools module files are missing. Install mtools before installing or running Quotes.';
        }

        $status = Mtools\Bootstrap::checkRuntime('1.0.0', '1.1.0');

        return $status['ok'] ? '' : Mtools\Bootstrap::statusMessage($status);
    }
}
```

For another module, rename the function:

```php
function mymodule_mtools_dependency_error(): string
```

Use the same minimum API and module version unless the mTools architecture
document says your helper requires a newer version.

## Step 4: Load the Bootstrap From Entry Points

Public and admin entry points should load the module bootstrap before using
classes that extend mTools helpers.

Quotes public bootstrap path:

```php
require __DIR__ . '/bootstrap.php';

$mtoolsDependencyError = quotes_mtools_dependency_error();
if ('' !== $mtoolsDependencyError) {
    redirect_header(XOOPS_URL, 3, $mtoolsDependencyError);
    exit;
}
```

Quotes admin bootstrap follows the same pattern and redirects with a clear
message if mTools is missing, inactive, or too old.

Do not let the first symptom be:

```text
Class "XoopsModules\Mtools\Common\SysUtility" not found
```

Fail early with a message that tells the site admin what to install or update.

## Step 5: Guard Install and Update Hooks

Install and update hooks run in contexts where preload order is not enough.
They must load the consumer bootstrap and check the dependency before using
mTools classes.

Quotes install hook:

```php
require dirname(__DIR__) . '/bootstrap.php';

function xoops_module_pre_install_quotes(\XoopsModule $module)
{
    $mtoolsDependencyError = quotes_mtools_dependency_error();
    if ('' !== $mtoolsDependencyError) {
        $module->setErrors($mtoolsDependencyError);

        return false;
    }

    $utility = new \XoopsModules\Quotes\Utility();

    $xoopsSuccess = $utility::checkVerXoops($module);
    $phpSuccess   = $utility::checkVerPhp($module);

    return $xoopsSuccess && $phpSuccess;
}
```

Quotes update hook does the same before it creates `Utility` or
`Mtools\Common\Configurator`.

This is the point that prevents broken partial installs.

## Step 6: Replace Local Common Inheritance With a Thin Adapter

The consumer should expose its own module class name while inheriting stable
mTools behavior.

Quotes `class/Utility.php`:

```php
<?php declare(strict_types=1);

namespace XoopsModules\Quotes;

use XoopsModules\Mtools;

class Utility extends Mtools\Common\SysUtility
{
    // Add only module-specific methods here.
}
```

This gives existing Quotes code a stable local name:

```php
$utility = new Utility();
$utility::checkVerPhp($module);
```

while the implementation comes from:

```php
XoopsModules\Mtools\Common\SysUtility
```

Do not keep a copied `class/Common/SysUtility.php` just to avoid changing one
`use` statement. The thin adapter is the bridge.

## Step 7: Use mTools Helpers Explicitly Where They Are Truly Shared

Quotes uses `Configurator` for module configuration paths and install-time
folder setup:

```php
$configurator = new \XoopsModules\Mtools\Common\Configurator($helper->path());

foreach ($configurator->uploadFolders as $folder) {
    $utility::prepareFolder($folder);
}
```

Use this pattern only for helpers that are documented as stable shared API.
If a helper needs the consuming module's dirname, path, template name, or URL,
pass that context explicitly. A shared helper must not infer that it is running
inside `mtools`.

## Step 8: Keep Templates and CSS in the Consumer

Do not move module templates into mTools just because the module consumes
mTools helpers.

Quotes keeps:

```text
modules/quotes/templates/
modules/quotes/templates/blocks/
modules/quotes/assets/css/style.css
```

This is intentional. Quote cards, author photos, category visuals, block
layouts, and dark-theme behavior are Quotes UI concerns.

mTools may eventually provide shared design tokens or rendering conventions,
but the consumer owns its final presentation.

## Step 9: Update Blocks

Blocks can run in side-column contexts where the full module page bootstrap may
not have run the way you expect.

Quotes block files start defensively:

```php
require_once dirname(__DIR__) . '/bootstrap.php';

use XoopsModules\Quotes\Helper;

if (!class_exists(Helper::class) || '' !== quotes_mtools_dependency_error()) {
    return [];
}
```

For your module, use the same idea:

- require the consumer bootstrap
- check the dependency
- return an empty block or a clear admin-visible message if the dependency is
  not satisfied

Do not let a side block fatal the whole page.

## Step 10: Remove the Old `class/Common/` Copy Carefully

After the module compiles and runs with mTools:

1. Search for references to the old namespace.
2. Replace local common-class imports with `XoopsModules\Mtools\Common\...`
   only when the helper is stable and documented.
3. Keep thin module adapters where existing module code expects local class
   names.
4. Delete only the unused local helper files.
5. Do not delete module-specific helpers.

Useful searches:

```bash
rg "class/Common|Common\\\\" modules/mymodule
rg "require_once .*mtools/preloads" modules/mymodule
rg "extends .*Common" modules/mymodule/class
```

No consumer class file should require mTools internals directly.

## Step 11: Test the Conversion

At minimum, verify these paths:

- module install fails clearly when mTools is missing or inactive
- module install succeeds when mTools is installed and active
- module update performs the same dependency check
- public index page loads
- public list/detail pages load
- admin dashboard loads
- admin blocks page saves
- blocks render without fatal errors
- PHP lint passes for edited files

For Quotes, the important smoke checks are:

```bash
php -l htdocs/modules/quotes/bootstrap.php
php -l htdocs/modules/quotes/include/mtools_dependency.php
php -l htdocs/modules/quotes/class/Utility.php
php -l htdocs/modules/quotes/include/oninstall.php
php -l htdocs/modules/quotes/include/onupdate.php
```

And representative URLs:

```text
/modules/quotes/
/modules/quotes/quote.php
/modules/quotes/category.php
/modules/quotes/author.php
/modules/quotes/admin/index.php
/modules/quotes/admin/blocksadmin.php
```

## Common Mistakes

### Requiring mTools internals from a class file

Wrong:

```php
require_once XOOPS_ROOT_PATH . '/modules/mtools/preloads/autoloader.php';
```

inside `class/Utility.php`.

Right:

```php
require __DIR__ . '/bootstrap.php';
```

from entry points and install/update hooks.

### Treating every mTools class as stable

Only `Common\...` plus the documented bootstrap/dependency classes are for
consumers. Check `docs/architecture.md` before adopting a helper.

### Moving UI into mTools

If the code renders a quote card, category grid, author image, or module block,
it belongs in the consumer module. mTools should not become a dumping ground
for every template fragment.

### Ignoring dark themes

Module CSS should use variables and theme-aware selectors where needed. Quotes
owns its dark-theme card colors because Quotes owns the quote-card UI.

### Copying unsafe filesystem helpers

Never promote helpers that process posted paths, call `chmod()` from raw input,
redirect at file scope, or perform filesystem writes during autoload. Split
those behaviors before sharing them.

## Conversion Checklist

- [ ] `xoops_version.php` declares `'min_modules' => ['mtools' => '1.1.0']`.
- [ ] Consumer `bootstrap.php` loads the consumer autoloader and public mTools
      bootstrap.
- [ ] Consumer has one dependency helper, e.g.
      `mymodule_mtools_dependency_error()`.
- [ ] Public/admin entry points check the dependency before using mTools-based
      classes.
- [ ] Install and update hooks check the dependency and return `false` with
      `$module->setErrors()` on failure.
- [ ] Thin local adapters replace copied common base classes.
- [ ] No class file requires `mtools/preloads/autoloader.php`.
- [ ] Only documented `Mtools\Common\...` helpers are consumed.
- [ ] Templates, blocks, CSS, language files, and domain handlers remain in the
      consumer module.
- [ ] Old local `class/Common/` files are removed only after references are
      gone.
- [ ] Public pages, admin pages, install/update hooks, and blocks are smoke
      tested.

## Recommended Migration Order

1. Add dependency metadata and bootstrap files.
2. Add install/update dependency checks.
3. Convert `Utility` to extend `Mtools\Common\SysUtility`.
4. Convert one additional stable helper, such as `Configurator`.
5. Run public/admin/block smoke checks.
6. Remove unused local `class/Common/` files.
7. Only then consider adopting more mTools helpers.

Small, verified conversions are better than a broad rewrite. Quotes is the
model: it consumes mTools for shared infrastructure, while still acting like a
normal, self-contained XOOPS module for its own data and UI.
