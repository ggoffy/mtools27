# mtools Shared-Helper Architecture

`mtools` is a XOOPS module that also hosts shared helper classes for other
modules. Consumer modules should depend on the public contract here, not copy
their own `class/Common/` folder.

## Runtime Contract

Consumers load mtools through:

```php
require_once XOOPS_ROOT_PATH . '/modules/mtools/bootstrap.php';
```

The bootstrap registers `XoopsModules\Mtools\...`, defines
`MTOOLS_API_VERSION`, and exposes `XoopsModules\Mtools\Bootstrap` for runtime
checks.

Consumer manifests should declare:

```php
$modversion['min_modules'] = ['mtools' => '1.1.0'];
```

Install and update hooks should call `Mtools\Bootstrap::checkRuntime()` before
instantiating classes that extend mtools helpers.

The first executable contract test is
`tests/Contract/QuotesConsumerContractTest.php`. It verifies that `quotes`
loads the public mtools API and that `XoopsModules\Quotes\Utility` extends
`XoopsModules\Mtools\Common\SysUtility` without requiring mtools internals from
the class file.

## Namespace Tiers

### Stable Shared API

`XoopsModules\Mtools\Common\...`

This tier is for helpers that consumer modules may extend or instantiate.
Semver applies. Breaking changes require a major version bump and a deprecation
path. Current stable candidates include:

- `Blocksadmin`
- `Breadcrumb`
- `Configurator`
- `DirectoryChecker`
- `FileChecker`
- `FilesManagement`
- `LetterChoice`
- `Migrate`
- `ModuleFeedback`
- `ModuleStats`
- `ObjectTree`
- `ServerStats`
- `SysUtility`
- `TestdataButtons`
- `TestdataSample`
- `UpdateChecker`
- `VersionChecks`

### Experimental

`XoopsModules\Mtools\Lab\...`

This tier is for helpers that are not yet safe as public API. They may change
between minor releases. Current Lab classes:

- `DataMapperInterface`
- `IdentityMap`
- `IdentityMapInterface`
- `IdentityMapTrait`
- `Repository`
- `RepositoryInterface`

### mtools-Local

`XoopsModules\Mtools\...` without a shared sub-namespace is module-local unless
documented otherwise. Consumers should not extend these classes except for the
explicit contract classes:

- `Bootstrap`
- `Module\Dependency`

## Side-Effect Rules

Shared classes must not:

- read browser request data at file scope
- redirect, echo, or exit at file scope
- write to the database during autoload
- inject theme assets during global preload execution
- perform filesystem writes from posted raw paths

UI helpers must accept the consuming module context explicitly when a template,
asset path, or module dirname is needed.

## XMF Graduation Gate

A helper can be proposed for XMF only after it has:

- at least one real consumer beyond the module that introduced it
- stable constructor and method signatures
- no module-relative assumptions
- no request or preload side effects
- documented behavior in this architecture file and class PHPDoc
- smoke, contract, and relevant integration tests
