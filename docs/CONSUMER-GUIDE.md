# Consuming mtools From a Module

`quotes` is the reference consumer.

For a full conversion walkthrough, see
[`CONVERTING-A-MODULE-WITH-MTOOLS.md`](CONVERTING-A-MODULE-WITH-MTOOLS.md).

## Manifest

Add a module dependency:

```php
$modversion['min_modules'] = ['mtools' => '1.1.0'];
```

## Module Bootstrap

Create a module-level `bootstrap.php`:

```php
require_once __DIR__ . '/preloads/autoloader.php';

if (defined('XOOPS_ROOT_PATH')) {
    $mtoolsBootstrap = XOOPS_ROOT_PATH . '/modules/mtools/bootstrap.php';
    if (is_file($mtoolsBootstrap)) {
        require_once $mtoolsBootstrap;
    }
}
```

Class files should not require mtools internals. Entry points, install hooks,
CLI scripts, and tests load the module bootstrap instead.

## Dependency Check

Before instantiating classes that extend mtools helpers:

```php
$status = \XoopsModules\Mtools\Bootstrap::checkRuntime('1.0.0', '1.1.0');
if (!$status['ok']) {
    $module->setErrors(\XoopsModules\Mtools\Bootstrap::statusMessage($status));
    return false;
}
```

Admin entry points should redirect with the same message. Install/update hooks
should return `false`.

## Reusing Helpers

Prefer thin extension classes in the consumer:

```php
namespace XoopsModules\Quotes;

use XoopsModules\Mtools;

final class Utility extends Mtools\Common\SysUtility
{
}
```

Do not create a local `class/Common/` copy unless the helper is genuinely
module-specific.
