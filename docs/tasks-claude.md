# mtools — Concept Review & Implementation Plan

Generated 2026-04-25.
Scope: review of `mtools` (the helper-host module) and `quotes` (the
proof-of-concept consumer). Goal: assess the architectural concept,
flag the issues, and lay out a sprint plan to get from the current PoC
to a state where helpers can graduate to XMF.

Status update: reconciled on 2026-04-25 after the bootstrap/dependency
implementation. Most Sprint 1-2 items are now implemented in code. Remaining
open items are mainly deeper helper-quality work, broader test coverage, and
future XMF promotion tasks.

> A prior generic per-module task list is preserved at
> `docs/tasks-claude-prior.md`. This file supersedes it for the
> shared-helper-host concept review.

> **TL;DR.** The concept is right. The execution has a handful of
> real problems: the "consumer extends helper" pattern works, but it
> bypasses the autoloader contract, has no version handshake, runs
> heavy DB+theme code in a `eventCoreFooterStart` preload on every
> XOOPS request, and ships untested DDD-style helpers (Repository,
> IdentityMap) alongside the traditional `XoopsObject` helpers without
> documentation. Sprint 1 fixes the per-request DB hit; Sprint 2
> fixes the dependency contract; Sprint 3 fixes the helpers' own
> code quality; Sprint 4 adds tests; Sprint 5 ships the XMF promotion
> migration plan.

---

## 1. The concept — what's being attempted

```
┌────────────────────────────────┐
│  XMF (long-term home)          │
│  Xmf\Module\Common\…           │
└──────────────▲─────────────────┘
               │ promote when stable
┌──────────────┴─────────────────┐
│  mtools (testing ground)       │
│  XoopsModules\Mtools\Common\…  │ ← 22+ shared classes & traits
└──────────────▲─────────────────┘
               │ extends / uses
┌──────────────┴─────────────────┐
│  Consumer modules              │
│  e.g. quotes (PoC):            │
│    class Utility extends       │
│      Mtools\Common\SysUtility  │
└────────────────────────────────┘
```

The `mtools/class/Common/` directory currently hosts:

**Traditional XOOPS helpers** (the `class/Common/` set every module
historically copy-pasted):
`Blocksadmin`, `Breadcrumb`, `Configurator`, `DirectoryChecker`,
`FileChecker`, `FilesManagement`, `LetterChoice`, `Migrate`,
`ModuleFeedback`, `ModuleStats`, `ObjectTree`, `ServerStats`,
`SysUtility`, `TestdataButtons`, `TestdataSample`, `VersionChecks`.

**Newer DDD-style helpers** (modern data-mapper / repository pattern
that does NOT mix with the legacy XoopsObject + handler approach):
`DataMapperInterface`, `IdentityMap`, `IdentityMapInterface`,
`IdentityMapTrait`, `Repository`, `RepositoryInterface`.

The PoC consumer `quotes` deleted its local `class/Common/` and
replaced its `Utility` class with:

```php
namespace XoopsModules\Quotes;
use XoopsModules\Mtools;
require_once XOOPS_ROOT_PATH . '/modules/mtools/preloads/autoloader.php';
class Utility extends Mtools\Common\SysUtility {}
```

**This works.** It is also the smallest possible change to
demonstrate consumption. As a PoC: success.

---

## 2. What the concept does right

- [x] Single-author-controlled incubator before promoting to XMF — the right "library cradle" pattern. XMF is upstream and slow-moving; mtools can iterate fast.
- [x] Inheritance-based reuse (`extends Mtools\Common\X`) — simple, works, no service-locator gymnastics, no DI container required.
- [x] Reuses existing XOOPS lifecycle — mtools is a regular installable module; consumers can declare it as a dependency the same way they declare any other module.
- [x] Already includes more sophisticated patterns than the legacy XOOPS Common/ subset (Repository, IdentityMap, DataMapperInterface) — leaves room for graduating modules into modern persistence patterns without inventing a new namespace.
- [x] Consumer remains shippable as a single zip — even with the dependency, no Composer install is required at runtime.
- [x] PoC successfully proves the namespace-and-autoloader cooperation between two modules.

---

## 3. Critical issues with the current PoC

### 3.1 [P0] `MtoolsCorePreload::eventCoreFooterStart()` runs on every XOOPS request

`preloads/core.php` lines 5-82 do, on EVERY request to ANY page on the
whole site:

- `SELECT … FROM mtools_setup` (DB read)
- `INSERT INTO mtools_setup` or `UPDATE mtools_setup` (DB write — uses the deprecated `queryF()` + raw string interpolation)
- `$xoTheme->addStylesheet(...)` (5+ stylesheet additions)
- `$_SESSION` mutation

This is unacceptable for a module that wants to be installed
defensively as a dependency. A consumer that installs mtools just for
the helpers now pays a DB write per request even on pages unrelated to
mtools or its consumers.

**Action:**
- [x] **Move the theme/setup logic to a different preload event** that fires only when mtools' admin is being rendered (e.g. `eventCoreModuleSetActive` keyed on `mtools`).
- [x] **Cache the setup row** so the read is at most once-per-session, not once-per-request.
- [x] **Remove the per-request INSERT/UPDATE** entirely — the row write should happen once at install or via an explicit admin action.
- [x] **Replace `$xoopsDB->queryF($sql)` + `'{$var}'` interpolation** with `exec()` + `quote()` per project rules. (This is also the bad-example consumers will copy.)
- [x] Keep ONLY `eventCoreIncludeCommonEnd` → `require __DIR__ . '/autoloader.php';` in `core.php`. Anything else moves to a separate per-need preload.

### 3.2 [P0] No dependency contract

`quotes/xoops_version.php` does NOT declare a dependency on mtools.
When quotes installs and mtools isn't present:
- The install completes (XOOPS doesn't check)
- The first request that reaches `Utility::method()` → fatal:
  `Class XoopsModules\Mtools\Common\SysUtility not found`

**Action:**
- [x] Add a `min_modules` field convention to consumer manifests:
      ```php
      $modversion['min_modules'] = ['mtools' => '1.2'];
      ```
- [x] Add a `xoops_module_pre_install_<dirname>` callback that aborts
      with a clear error message if any required module is missing or
      below the required version.
- [x] Add a small helper in `mtools` itself
      (`Mtools\Module\Dependency::require($name, $minVersion)`) that
      consumers call from their pre-install / pre-update hooks.
- [x] Document the dependency in every consumer's README.
- [ ] When uninstalling mtools, the system module already prevents it
      if any other module depends on it via `min_modules` — verify
      this still works once `min_modules` is wired up.

### 3.3 [P0] Consumer's `class/Utility.php` does `require_once` at top of file

`quotes/class/Utility.php`:

```php
namespace XoopsModules\Quotes;
use XoopsModules\Mtools;
require_once XOOPS_ROOT_PATH . '/modules/mtools/preloads/autoloader.php';
class Utility extends Mtools\Common\SysUtility {}
```

Problems:
- Class file with side effects at top — anti-pattern. The autoloader
  loads this file when `XoopsModules\Quotes\Utility` is referenced;
  the require runs on first reference.
- Duplicates work mtools' own preload already does — when mtools is
  active, `MtoolsCorePreload::eventCoreIncludeCommonEnd` has already
  registered the autoloader at XOOPS bootstrap.
- Falls apart if mtools is not active (which is the case §3.2 should
  prevent in the first place).
- If quotes' autoloader is registered before mtools' preload runs
  (edge case — class touched in a XOOPS bootstrap event), the require
  becomes load-bearing. Order-dependent. Bad.

**Action:**
- [x] **Remove the `require_once` line from `quotes/class/Utility.php`**. With a proper dependency check (§3.2) and mtools' preload (§3.1), the class file becomes side-effect-free.
- [x] Add a one-time defensive autoloader registration in `mtools/class/Helper.php::__construct()` so that even if the preload is skipped (e.g. CLI or test), the autoloader is registered when the Helper is first touched.
- [x] Update the consumer documentation to NEVER require mtools internals from a class file.

### 3.4 [P1] Consumer's autoloader is mtools-blind

`quotes/preloads/autoloader.php` only knows `XoopsModules\Quotes\` →
`quotes/class/`. It cannot resolve `XoopsModules\Mtools\Common\X`. The
fact that the PoC works depends entirely on mtools' own preload
registering its autoloader first.

**Action:**
- [x] Document the autoloader cooperation: mtools' preload registers
      `XoopsModules\Mtools\` and consumers' preloads register their
      own. Each module owns its own namespace; there's no "consumer
      autoloads dependencies" pattern.
- [ ] Verify load order: in XOOPS the preload event order is by
      module weight / install order. Document the expected order and
      add a defensive registration in mtools' Helper as in §3.3.
- [ ] Add a phpunit test that loads quotes' Utility WITHOUT first
      loading mtools' preload, and verifies it fails with a clear
      message (not a generic `class not found`).

### 3.5 [P1] mtools' `composer.json` is malformed

```json
{
    "require": {
        "pmjones/auto-route": "^2.0"
    }
}
```

No `name`, no `description`, no `autoload`, no `license`, no
`require-dev`, no `php` constraint. It only declares a runtime
dependency on a package most consumers don't need.

**Action:**
- [x] Rewrite `composer.json`:
      ```json
      {
        "name": "xoopsmodules25x/mtools",
        "type": "xoops-module",
        "description": "Shared helper traits and classes for XOOPS modules; testing ground before XMF promotion",
        "license": "GPL-2.0-or-later",
        "require": {
          "php": ">=8.2 <8.6",
          "xoops/xmf": "^1.3"
        },
        "require-dev": {
          "phpunit/phpunit": "^11.2",
          "phpstan/phpstan": "^1.11",
          "vimeo/psalm": "^5.26",
          "friendsofphp/php-cs-fixer": "^3.64"
        },
        "autoload": {
          "psr-4": {"XoopsModules\\Mtools\\": "class/"}
        },
        "autoload-dev": {
          "psr-4": {"XoopsModules\\Mtools\\Tests\\": "tests/"}
        },
        "scripts": {
          "test": ["@analyse", "@unit"],
          "unit": "phpunit",
          "analyse": "phpstan analyse"
        }
      }
      ```
- [x] Decide whether `pmjones/auto-route` belongs as a runtime dep
      (only if mtools itself routes admin pages with it) or move to
      `require-dev`.
- [x] Drop `node_modules/`, `package.json`, `yarn.lock` from release
      zips via `.gitattributes` `export-ignore` — these are dev-time
      artefacts.

### 3.6 [P1] `MTOOLS_PATH` / `MTOOLS_URL` constants in `mtools_header.php` are unused dead-end

`mtools_header.php` defines `MTOOLS_PATH` and `MTOOLS_URL` and registers
the autoloader. But:
- No consumer is documented to require this file.
- The constants are never referenced in mtools' own code (grep
  result: 0 hits in `class/`, `include/`, `admin/`).
- The require-mainfile dance (`if (!defined('XOOPS_ROOT_PATH'))`) is
  the legacy direct-script-execution pattern.

**Action:**
- [x] Decide what `mtools_header.php` is for. Two options:
  1. **Delete it.** Consumers don't need it; the preload handles
     bootstrap. The constants aren't used.
  2. **Make it the public consumer entry point**, document it as
     `require_once XOOPS_ROOT_PATH . '/modules/mtools/mtools_header.php';`
     for any consumer that wants the constants. But still useless if
     the constants don't carry value.
- [x] If kept, add a constant `MTOOLS_VERSION` so consumers can do
      runtime version checks instead of poking `xoops_version.php`.

### 3.7 [P1] Heterogeneous helper set without scope boundaries

The `Common/` directory mixes:

| Group | Contents | Maturity |
|---|---|---|
| Legacy XOOPS helpers | Blocksadmin, Breadcrumb, Configurator, DirectoryChecker, FileChecker, FilesManagement, LetterChoice, Migrate, ModuleFeedback, ModuleStats, ObjectTree, ServerStats, SysUtility, TestdataButtons, TestdataSample, VersionChecks | "Battle-tested" but contains the same FileChecker/DirectoryChecker security issue flagged in the WG audit (browser-driven filesystem actions) |
| Modern DDD layer | DataMapperInterface, IdentityMap, IdentityMapInterface, IdentityMapTrait, Repository, RepositoryInterface | New code, no consumers, no tests, no docs |

Mixing them in one namespace says "use whichever you want". A consumer
that mixes `extends Common\SysUtility` (XoopsObject-handler world)
with `Common\Repository` (POPO + data-mapper world) ends up with two
incompatible mental models in one module.

**Action:**
- [x] Split into two sub-namespaces:
      - `XoopsModules\Mtools\Common\*` — legacy helpers, stable, what
        every existing module should adopt today
      - `XoopsModules\Mtools\Domain\*` (or `Modern\*`, `Ddd\*`,
        `Persistence\*`) — modern data-mapper / repository, opt-in
- [x] Document which set is appropriate for which kind of module
      (legacy refactor vs. greenfield modern persistence).
- [ ] Don't promote the modern set to XMF until at least one real
      module has used it end-to-end.

### 3.8 [P1] Apply the WG-audit security fix to FileChecker / DirectoryChecker

The cross-cutting WG audit identified that `FileChecker` and
`DirectoryChecker` accept browser-posted paths to drive `copy()`,
`mkdir()`, `chmod()`, `unlink()` operations. The same code lives in
mtools (verified — `mtools/class/Common/FileChecker.php` and
`DirectoryChecker.php` exist).

**Action:**
- [x] Refactor both helpers to:
  1. Accept allowlist keys (e.g. `'uploads'`, `'thumbs'`), not raw paths
  2. Resolve keys via `Configurator::getPath($key)` to absolute paths
  3. `realpath()` containment check before any filesystem op
  4. Default mkdir mode `0755`, file mode `0644` (not `0777`)
- [x] **Do this BEFORE quotes or any other consumer adopts these two
      helpers.** Otherwise the bug propagates to every consumer.
- [ ] Add unit tests that drive the helpers with malicious paths
      (`../../etc/passwd`) and assert rejection.

### 3.9 [P2] No tests for any helper

`mtools/tests/` contains only an `index.php` anti-indexing stub.
The 22+ shared classes and traits are unguarded. Bug fix in any of
them ships untested across N consumers.

**Action:**
- [ ] One PHPUnit test per helper, minimum smoke coverage. PHPUnit 11
      attribute syntax (`#[Test]`, `#[CoversClass]`, `#[DataProvider]`).
- [ ] Test base class that stubs `XoopsObject` / `XoopsMySQLDatabase` /
      `Criteria` (reuse the starter kit's `phpstan-bootstrap.php`
      stubs).
- [ ] CI workflow at `.github/workflows/phpunit.yml` matrix PHP 8.2 / 8.3 / 8.4 / 8.5.
- [ ] **No helper is promoted to XMF until it has tests.**

### 3.10 [P2] Versioning has no contract

`xoops_version.php` says `'version' => '1.1.0'` but mtools is treated
by consumers as if it has a fixed API. There's no:
- semver discipline (1.1.0 → 1.2.0 means what? what's a breaking change?)
- `@deprecated` markers on methods being phased out
- `class_alias` shims when classes are renamed
- changelog discipline

**Action:**
- [x] Adopt strict semver. Document in `docs/VERSIONING.md`:
      - Major bump = breaking change to a `Common\*` public class/method
      - Minor bump = new helper added or new method
      - Patch bump = bug fix
- [ ] Adopt the project's conventional-commits + git-cliff CHANGELOG
      generation (the starter kit has the template — copy `cliff.toml`).
- [ ] When deprecating a method/class, add `@deprecated since 1.x`
      PHPDoc, keep working for one major cycle, ship a `class_alias`
      if the FQCN changes.

---

## 4. Lower-priority architecture decisions

### 4.1 Module vs. library

mtools is a XOOPS module (with admin pages, install SQL, language
files, manifest) but also a library (Common helpers consumed by other
modules). Both roles in one folder.

**Two clean alternatives:**

**(A) Module-only — embrace the module role**
- Move admin work into proper concerns (module status dashboard, etc.)
- Helpers are "exposed" via the namespace
- Library role is implicit
- Pro: simpler to install/uninstall via XOOPS UI
- Con: heavier than necessary for pure helpers

**(B) Library-first with thin module shell**
- Move helpers under `lib/` or `src/` outside `class/`
- The "module" is just the install scaffold and a status admin page
- A future Composer-installable package layout: drop the module wrapper, ship as `xoops/module-common` on Packagist
- Pro: easier path to XMF promotion (just rename namespace)
- Con: requires Composer at install time

**Recommendation:** stay (A) for now (zero-friction install for
existing XOOPS sites), but plan (B) for the XMF-promotion path. The
Common\* classes are ALREADY at `class/Common/` which matches both
layouts — no immediate move needed.

### 4.2 Documentation gap

There is no `mtools/README.md` content explaining:
- What helpers exist
- When to use which helper
- How to consume from another module
- The XMF-promotion roadmap

**Action:**
- [x] Write `docs/USAGE.md` with one section per helper:
      ```
      ### SysUtility
      Purpose: …
      Usage: `class Utility extends \XoopsModules\Mtools\Common\SysUtility {}`
      Provides: checkVerXoops, checkVerPhp, getServerStats, …
      Stable since: 1.0.0
      Promotion target: Xmf\Module\Common\SysUtility (planned 1.5)
      ```
- [x] Write `docs/CONSUMER-GUIDE.md` with the canonical adoption pattern.
- [x] Update root `README.md` with a 1-paragraph summary + link to docs.

### 4.3 Why "Common"?

The traditional XOOPS name is `Common\` (every module that has helpers
puts them under `class/Common/`). For a host module this is mildly
misleading — "Mtools' Common" reads like "stuff common to Mtools",
not "stuff shared across modules".

**Recommendation:** keep the name `Common\` for compatibility — the
name matches what consumers historically migrate FROM (their own
`class/Common/`). Document the meaning ("shared across modules") in
the README. Renaming after consumers adopt would be a breaking change.

---

## 5. Implementation plan

### Sprint 1 — Stop the per-request damage (1-2 days)

Goal: mtools can be installed defensively without imposing a
per-request DB hit on the whole site.

- [x] Strip `MtoolsCorePreload::eventCoreFooterStart()` of its DB and theme work; either delete the method or move it to an event keyed on mtools-active-module.
- [x] Replace remaining `queryF()` + raw-string SQL with `exec()` + `quote()`.
- [x] Cache the `mtools_setup` row read across a request (and ideally across a session) instead of running it on every page.
- [ ] Verify no behavioural regression on a test site with mtools installed but inactive.

### Sprint 2 — Dependency contract (1-2 days)

Goal: a consumer that installs without mtools either fails fast at
install time or reports a clear error, never a `class not found` at
runtime.

- [x] Add `Mtools\Module\Dependency::require($name, $minVersion)` helper.
- [x] Add the canonical `xoops_module_pre_install_<dirname>` block to the consumer template.
- [x] Document `'min_modules' => ['mtools' => '1.x']` in xoops_version.php as the consumer convention.
- [x] Wire the same check into `xoops_module_pre_update_<dirname>`.
- [x] Update quotes (the PoC) to use this pattern; remove the inline `require_once` from `Utility.php`.
- [x] Add a defensive `register_autoload` call in `Mtools\Helper::__construct` for paths where the preload didn't fire (CLI, test).

### Sprint 3 — Helper code quality (3-5 days)

Goal: the helpers themselves are good enough to graduate to XMF.

- [x] Apply the WG-audit FileChecker/DirectoryChecker security fix (§3.8) — allowlist + realpath containment + 0755/0644 defaults.
- [ ] Run PHPStan level 5+ across `class/Common/` and `class/Domain/`; fix or baseline.
- [ ] Run Psalm errorLevel 4; fix or baseline.
- [ ] Replace remaining `queryF()` calls inside helpers with `exec()`/`query()`.
- [ ] Add the two-part fetch guard everywhere (`isResultSet($r) && $r instanceof \mysqli_result`).
- [ ] PHP 8.4 implicit-nullable param sweep (Rector pass).
- [ ] PHP 8.2-8.5 typed properties + return types on every public method.

### Sprint 4 — Tests (3-5 days)

Goal: every helper has a smoke test; the legacy + modern split is
validated.

- [x] Split namespace: `Common\*` (legacy) vs `Domain\*` (DDD/repository).
- [ ] One PHPUnit smoke test per helper class/trait (24 helpers → 24 test classes minimum).
- [ ] At least one Integration test per helper that touches DB (use sqlite in-memory or a docker mariadb fixture).
- [ ] CI workflow: phpunit + phpstan + psalm + cs-fixer matrix on PHP 8.2 / 8.3 / 8.4 / 8.5.
- [ ] Code coverage report; aim for >70% across `class/Common/`.

### Sprint 5 — Documentation + consumer guide (2-3 days)

Goal: a second consumer (beyond quotes) can adopt without asking the author.

- [x] `docs/USAGE.md` — one section per helper with stable-since version and XMF-promotion target.
- [x] `docs/CONSUMER-GUIDE.md` — the canonical "how to depend on mtools" walkthrough.
- [x] `docs/VERSIONING.md` — semver + deprecation policy.
- [ ] `cliff.toml` + git-cliff-driven CHANGELOG (copy from starter kit).
- [x] Update `README.md` root with a one-paragraph project summary and link to docs.

### Sprint 6 — Adopt across 3+ more consumer modules (timeboxed validation)

Goal: prove the pattern scales. Pick three real modules from the WG
tree (smallest first: e.g. wgsitenotice, wgteams, wgblocks) and migrate
each from local `class/Common/` to `extends Mtools\Common\*`. Capture
the diff per module, the time it took, and any helper that needed to
change to support the migration.

- [ ] wgsitenotice migration; review.
- [ ] wgteams migration; review.
- [ ] wgblocks migration; review.
- [ ] Commit the lessons: any helper that had to change is *NOT* yet stable enough for XMF.
- [ ] Promote the unchanged-after-3-consumers helpers to XMF (Sprint 7).

### Sprint 7 — XMF promotion (per helper, ongoing)

Trigger per helper: stable for ≥6 months, no breaking changes, ≥3
consumers, tests green on all PHP 8.2-8.5 matrix.

- [ ] Open RFC in XMF repo proposing the helper's promotion.
- [ ] On accept: helper moves to `Xmf\Module\Common\X` (or wherever XMF wants it).
- [ ] mtools keeps `Mtools\Common\X` as a deprecated alias re-exporting the XMF class via `class_alias` for one major release cycle.
- [ ] Consumers update their `extends` statement at their leisure during the deprecation window.
- [ ] After the cycle: the alias is removed; mtools no longer ships the class.

---

## 5b. P0 items added by cross-review with codex (jump to §7 for detail)

Before Sprint 1 starts, three additional P0 items are now on the
table (originally missed; caught by codex):

- [x] **§7.1** Remove file-scope request handling from `class/Common/FileChecker.php` and `DirectoryChecker.php` — these files currently process `$_POST` / `header()` / filesystem writes at the top level, making the autoloader itself unsafe.
- [x] **§7.2** Fix `class/Common/Breadcrumb.php` template-path inference — currently resolves `mtools` instead of the consumer's dirname, silently breaking inheritance for any UI helper.
- [x] **§7.3** Remove `$xoTheme->addScript()` / `addStylesheet()` calls from `MtoolsCorePreload::eventCoreFooterStart()` — bootstrap/jQuery is being injected on every site request, not just on mtools or consumer pages.

## 6. Open questions worth deciding before Sprint 1

- [x] **Runtime scope of mtools.** Is mtools-installed-but-inactive a supported state? If yes, none of the eventCoreFooterStart code can run. If no, document that consumers must keep mtools active. Recommend: **yes, supported as inactive**; preload runs autoloader only.
- [x] **Composer-or-not**. Today the PoC works without Composer (mtools' preload registers a hand-rolled autoloader). Composer would be cleaner but adds an install step XOOPS site admins are not used to. Recommend: **stay non-Composer at runtime**; use Composer in `dev` for testing only.
- [x] **`Common\*` vs `Domain\*` boundary.** Which subset is the real ground for promotion to XMF? Recommend: only `Common\*` (the legacy XOOPS helpers) is on the XMF promotion track. `Domain\*` is opt-in modern persistence and probably has a different future home (could be a separate Composer package, never XMF).
- [x] **Canonical consumer template.** Once Sprint 2 lands, the starter kit (`00_xoops-module-starter1-claude/`) should be updated with the dependency-on-mtools pattern as one option in `docs/CONSUMER-GUIDE.md`. Recommend: leave the starter kit as standalone (no mtools dep by default) and document mtools adoption as a follow-up step.
- [x] **PoC migration completion.** Quotes consumes `SysUtility` but probably could use more (`VersionChecks`, `Configurator`, `Migrate`, `ServerStats`). Verify quotes before and after fully, not just `Utility extends`.

---

## 7. Additions from cross-review with codex (2026-04-25)

After writing the above, reviewed codex's parallel `tasks-codex.md` and
found several items worth adopting. The biggest gaps in the original
analysis:

### 7.1 [P0 — critical] `FileChecker.php` and `DirectoryChecker.php` behave like CONTROLLERS at file scope

This goes beyond the "browser-driven filesystem actions" issue I
flagged in §3.8. Codex caught that these files don't just *accept*
browser-posted paths inside their methods — the file itself
**executes request-handling and redirect logic at file scope**.

That means **simply autoloading the class triggers admin behaviour**.
A library file that does `header('Location: …')` or processes `$_POST`
at top level cannot be safely required by another module's autoloader.

**Action:**
- [x] Read `class/Common/FileChecker.php` and `class/Common/DirectoryChecker.php` line by line. Move every line that:
  - Reads `$_GET`/`$_POST`/`$_REQUEST`/`$_FILES`
  - Calls `header()` / `redirect_header()` / `exit`
  - Performs filesystem ops (`copy`/`mkdir`/`chmod`/`unlink`)
  - Echoes output
  ...OUT of the class file and into a separate admin endpoint
  (`admin/filechecker.php`, `admin/directorychecker.php`).
- [x] The class file is left as a pure class — methods only, called
      by the admin endpoint OR by consumers programmatically.
- [x] Verify by autoloading the class in isolation (e.g. PHPUnit) and
      asserting no output, no redirects, no DB calls.

### 7.2 [P0] `Breadcrumb.php` infers its rendering template from the mtools dirname

A shared UI helper that hardcodes the host module's dirname will
render templates from `modules/mtools/` even when called from
`quotes`. The consumer's own breadcrumb visual ends up being mtools'.
This silently breaks the entire `extends Mtools\Common\X` inheritance
pattern for any UI helper.

**Action:**
- [x] Refactor `class/Common/Breadcrumb.php` to accept the consuming
      module's dirname (or a renderer / template path) explicitly via
      constructor or method parameter.
- [x] Audit other UI helpers (`ModuleStats`, `ModuleFeedback`,
      `LetterChoice`, `Blocksadmin`, `TestdataButtons`) for the same
      antipattern — anywhere a template path or asset URL is computed
      from `basename(dirname(__DIR__, 2))` and that resolves to
      `mtools` instead of the consumer.
- [ ] Add a unit test: instantiate `Breadcrumb` from a test consumer
      and assert it loads templates from the consumer, not mtools.

### 7.3 [P0] `eventCoreFooterStart` ALSO injects jQuery/Bootstrap on every page

§3.1 above flagged the DB writes. Codex caught that the same method
also calls `$xoTheme->addScript('browse.php?Frameworks/jquery/jquery.js')`
and `addStylesheet('… bootstrap.css')` on every page request — even
on pages that have no module from the WG family installed and don't
use any Mtools\Common\* helper.

**Action (add to Sprint 1):**
- [x] Remove the `$xoTheme->addScript()` / `addStylesheet()` calls
      from `eventCoreFooterStart`. Asset injection is a per-page
      concern and belongs in the controller of the page that needs
      it, not in a global preload.
- [x] If the bootstrap-version detection logic is genuinely needed,
      move it to a one-shot install-time write to `mtools_setup`
      with no per-request reads.

### 7.4 [P1] `VersionChecks.php` mixes local checks with GitHub API polling

`checkVerXoops()` and `checkVerPhp()` are pure local checks — perfect
for a foundational trait. `checkVerModule()` does cURL to
`api.github.com` to fetch latest release info. The two have nothing
in common except the word "version". Mixing them means:
- Every consumer that uses `VersionChecks` for local checks pulls in
  cURL as a transitive code dependency
- The trait is no longer pure — it has hidden network I/O
- Hard to test in isolation (the cURL path needs mocking)

**Action:**
- [x] Split `class/Common/VersionChecks.php` into two:
  - `class/Common/VersionChecks.php` keeps `checkVerXoops` and
    `checkVerPhp` only (pure local trait)
  - New `class/Common/UpdateChecker.php` (a service class, not a
    trait) hosts `checkVerModule` and any other GitHub-API logic
- [x] Consumers that need both opt into both explicitly.

### 7.5 [P1] Maturity-based namespace split, not pattern-style

§3.7 proposed splitting `Common\*` (legacy XOOPS) vs `Domain\*`
(DDD/repository). Codex's framing is sharper and better:

| Tier | Namespace | Meaning |
|---|---|---|
| Public stable | `XoopsModules\Mtools\Common\*` | API frozen except for backward-compatible additions; semver applies; this tier is on the XMF promotion track |
| Experimental | `XoopsModules\Mtools\Lab\*` (or `Experimental\*`) | Active iteration; consumers know they may break on a version bump; not on the XMF track until graduated |
| Module-local | `XoopsModules\Mtools\*` (no sub-namespace) | mtools' own internals; never consumed by other modules |

This split is by **maturity**, not by **architectural style**. The
DDD helpers (Repository, IdentityMap) start in `Lab\*` and graduate
to `Common\*` once they have a real consumer + tests + stable API.
Same gate applies to any new helper.

**Action (replace §3.7 framing):**
- [x] Three-tier namespace split: `Common\` (stable, XMF-track),
      `Lab\` (experimental, iterate freely), unprefixed (mtools-only).
- [x] Move `Repository`, `RepositoryInterface`, `IdentityMap`,
      `IdentityMapInterface`, `IdentityMapTrait`, `DataMapperInterface`
      into `Lab\` until at least one real consumer adopts them.
- [x] Document the tiers in README + docs/architecture.md.

### 7.6 [P1] Single `bootstrap.php` entrypoint instead of preload + ad-hoc require_once

§3.3 said "remove the require_once from quotes". Codex's framing:
provide a single canonical entry point `modules/mtools/bootstrap.php`
that consumers explicitly require, with that file doing autoload
registration + dependency/version checks in one place.

This is cleaner than relying on the preload (which only fires when
mtools is active in a XOOPS-bootstrapped request — fails for CLI,
test, install hooks) PLUS scattering ad-hoc `require_once` lines.

**Action:**
- [x] Create `modules/mtools/bootstrap.php` that:
      - Registers the autoloader (idempotent)
      - Asserts mtools is at minimum required version
      - Throws / returns a clear error message on any contract failure
- [x] Document `require_once XOOPS_ROOT_PATH . '/modules/mtools/bootstrap.php';`
      as the canonical consumer entry point — for use in install hooks,
      CLI scripts, tests, and any place the preload may not have run.
- [x] Web-request consumer code keeps relying on the preload (no
      explicit require needed) — bootstrap.php is for the cases the
      preload doesn't cover.

### 7.7 [P1] `docs/architecture.md` is missing

§4.2 mentioned USAGE.md and CONSUMER-GUIDE.md. Codex specifically
calls for an `architecture.md` that classifies every shipped class
into:
- public shared API (what consumers may extend / use)
- experimental (Lab tier — what consumers should NOT depend on)
- module-local (mtools-internal, never extended)

This is the contract document — without it, "what's reusable?" is
folklore.

**Action (add to Sprint 5):**
- [x] Write `docs/architecture.md` listing every class under `class/`
      with its tier and stability promise.
- [x] Update on every helper add / promote / deprecate.

### 7.8 [P2] Distribution boundary is wider than `node_modules`

§3.5 mentioned `node_modules/`, `package.json`, `yarn.lock`. Codex
adds `vendor/`, `composer.lock`, generated vendor tests, JS build
artifacts. None of these belong in an installable XOOPS module zip.

**Action:**
- [x] Expand `.gitattributes` `export-ignore` block:
      ```
      /vendor             export-ignore
      /node_modules       export-ignore
      /composer.lock      export-ignore
      /package.json       export-ignore
      /yarn.lock          export-ignore
      /package-lock.json  export-ignore
      /tests              export-ignore
      /.github            export-ignore
      /phpstan*.neon      export-ignore
      /phpunit.xml.dist   export-ignore
      /psalm.xml          export-ignore
      /.php-cs-fixer.dist.php export-ignore
      /rector.php         export-ignore
      /assets/src         export-ignore
      ```
- [ ] If consumers need composer at runtime, ship a stripped
      `vendor/` containing only the runtime deps via
      `composer install --no-dev --classmap-authoritative`.

### 7.9 [P2] Contract tests using `quotes` as the first consumer

§3.9 / Sprint 4 covered per-helper smoke tests. Codex adds: tests
that verify the consumer-facing CONTRACT, not just isolated helpers.

Distinct: a smoke test for `SysUtility::checkVerPhp` proves the
method works in isolation. A contract test verifies that **a quotes
class extending `Mtools\Common\SysUtility` can call `checkVerPhp` and
get the expected behaviour** — which catches things like Breadcrumb's
template-path bug (§7.2).

**Action (add to Sprint 4):**
- [x] `tests/Contract/QuotesConsumerTest.php` (or similar) — drives
      the public API the way a consumer would.
- [ ] One contract test per public class: bootstrap loading,
      install-time dependency failure modes, helper-as-base-class
      inheritance behaviour, asset/template path resolution.

### 7.10 [P1] `Configurator` as typed DTO

§3.7 mentioned typed properties generally. Codex specifically calls
out `Configurator` as a "good shared pattern that needs a typed
contract" — replace its loose mixed-typed properties (`$uploadFolders`,
`$copyBlankFiles`, `$oldFiles`, etc.) with a typed DTO so consumers
have a checkable contract instead of an array-of-strings convention.

**Action:**
- [x] Refactor `class/Common/Configurator.php` to typed properties:
      ```php
      public array /* list<string> */ $uploadFolders   = [];
      public array /* list<string> */ $copyBlankFiles  = [];
      public array /* list<string> */ $oldFiles        = [];
      public array /* list<string> */ $oldFolders      = [];
      public array /* array<string,string> */ $renameTables  = [];
      public array /* array<string,array{from:string,to:string,ddl:string}> */ $renameColumns = [];
      ```
- [x] PHPStan-typed array shapes via PHPDoc.
- [ ] Tests that verify the contract.

### 7.11 [P2] Graduation criteria — explicit list

Sprint 7 said "stable for ≥6 months, no breaking changes, ≥3
consumers, tests green". Codex's formulation is more concrete and
worth adopting verbatim as the graduation gate:

A class moves from `Mtools\Common\*` → `Xmf\*` ONLY after meeting
ALL of these:

- [ ] At least one real consumer module (not just quotes — at least one
      module that didn't help build the helper)
- [ ] Stable constructor + method signatures (no breaking changes for
      a documented period — recommend ≥6 months)
- [ ] No module-relative assumptions (no `basename(dirname(__DIR__))` for
      anything other than its own dirname; no hardcoded `mtools`)
- [ ] No request-side effects (no `header()`, no `echo`, no `exit`, no
      `$_GET/$_POST/$_FILES` access, no cookie writes)
- [ ] Documented behaviour (`docs/architecture.md` entry + class-level
      PHPDoc with examples)
- [ ] Tests: smoke + contract + at least one integration test

Add this gate to Sprint 7's checklist and to `docs/VERSIONING.md`.

---

## 8. Updated sprint plan (with codex additions)

The original Sprint 1-7 stand. Items added from §7:

- **Sprint 1** adds: §7.3 (remove jQuery/Bootstrap injection from preload).
- **Sprint 2** adds: §7.6 (create `bootstrap.php` entrypoint).
- **Sprint 3** adds: §7.1 (file-scope code → admin endpoints), §7.2 (Breadcrumb dirname-inference fix), §7.4 (split VersionChecks), §7.10 (Configurator typed DTO).
- **Sprint 4** adds: §7.9 (contract tests).
- **Sprint 5** adds: §7.5 (3-tier namespace split documented), §7.7 (architecture.md), §7.8 (distribution boundary in .gitattributes).
- **Sprint 7** adds: §7.11 (explicit graduation criteria).

Total cross-review delta: 11 new actionable items, of which 3 are P0
(file-scope code in shared classes, Breadcrumb dirname inference,
asset injection in preload), 6 are P1, 2 are P2.

---

## 9. What to do if you disagree with any of this

The biggest single decision is whether `MtoolsCorePreload::eventCoreFooterStart`
stays per-request or moves to an on-demand event. If you have a reason
the per-request work is necessary (e.g. theme detection that *must*
run before content renders), Sprint 1 changes shape — but the DB write
must move regardless. If you keep the per-request DB read, at least
gate it behind a session cache so the second request in a session
skips it.

The second-biggest is whether `Domain\*` (Repository, IdentityMap)
ships in the same package as `Common\*`. If your roadmap is to migrate
all WG modules to data-mapper persistence, keep them together. If
not, splitting them now keeps the surface that promotes to XMF small
and well-defined.

Everything else is implementation detail — fixable in any order.
