# mtools — Improvement Tasks

Module path: `htdocs/modules/mtools/`
PHP files: 85, TPL files: 15, has composer.json: Y, has phpstan: Y, has tests: Y, has preloads: Y, has sql/: Y

Utility / sysadmin-helper toolbox module. v1.1.0. Has `composer.json`, `composer.lock`,
`node_modules/`, `package.json`, `yarn.lock`, `vendor/` at module root — a
dev toolchain shipped alongside runtime code. Most of what follows is clean-up
rather than hardening.

Scope of this file: actionable tasks for modernising, hardening, and aligning this
module to XOOPS 2.7 / PHP 8.2–8.5 / Smarty 4 conventions.

## 1. Critical — security and correctness

- [ ] Admin gate: as a toolbox module, every admin action must verify
      `xoops_isadmin` before any side effect.
- [ ] CSRF: every POST action must validate the XOOPS security token BEFORE
      state change.
- [ ] Verify XOOPS_ROOT_PATH guard is first executable statement on every
      front-facing `.php` entry.
- [ ] **Do NOT ship `node_modules/` to production.** The directory is build
      debris and often contains vulnerable JS packages. Exclude from release
      archive AND from the site install.

## 2. Database & SQL

- [ ] Replace `->queryF(...)` with `->exec()` or `->query()`. 12 sites across 7
      files:
      `include/onupdate.php` (1), `preloads/core.php` (1),
      `include/oninstall.php` (2), `class/Common/Blocksadmin.php` (2),
      `testdata/index.php` (2), `class/Common/SysUtility.php` (2),
      `class/Common/TestdataSample.php` (2).
- [ ] Every `fetchArray/fetchRow/fetchBoth` must use the two-part guard
      `isResultSet($r) && $r instanceof \mysqli_result`.
- [ ] Type-hint constructor DB parameters as `XoopsMySQLDatabase`.
- [ ] Criteria `IN` clauses: pass array, never `implode(',', ...)`.
- [ ] Rename query-result variables to `$result`.
- [ ] Review `sql/mysql.sql`: InnoDB, utf8mb4, no FK REFERENCES in dump, explicit
      INSERT column names.

## 3. PHP 8.2–8.5 compatibility

- [ ] Convert implicit-nullable params to explicit `?Type`.
- [ ] Add explicit return types to public methods in `class/`.
- [ ] Remove bare references to conditionally-defined constants.

## 4. Security hardening

- [ ] Replace raw `$_GET/$_POST/$_REQUEST` access with `Xmf\Request::getXxx()`.
- [ ] All `unserialize()` calls need `['allowed_classes' => false]`.
- [ ] Template XSS: every user-originated variable via `|escape`.

## 5. XOOPS conventions

- [ ] Run `bash scripts/check-mi-constants.sh language/` — constants must be
      `_MI_MTOOLS_…`, `_AM_MTOOLS_…`, `_MD_MTOOLS_…` (matches current manifest).
- [ ] All admin pages: `xoops_cp_header()` / `xoops_cp_footer()` /
      `$xoBreadCrumb->addLink()` / `<{include file="db:system_header.tpl"}>`.
- [ ] Eliminate `global $xoopsDB/$xoopsUser/...` in new code (a `global $xoopsConfig`
      line is already at the top of `xoops_version.php` line 3 — evaluate
      whether it is strictly necessary; most of the manifest doesn't need it).
- [ ] Add `defined('XOOPS_ROOT_PATH') || exit('Restricted access');` as first
      executable line in every class/include file.
- [ ] `mtools_header.php` at module root — rename to `include/header.inc.php`
      and adjust includes.

## 6. Smarty templates

- [ ] Verify all 15 `.tpl` files use `<{ }>`.
- [ ] Apply `|escape` on every user-originated variable.
- [ ] Register every template in `xoops_version.php['templates']`.

## 7. Tests & quality gates

- [ ] `composer.json` present — audit dependencies, ensure PHP >=8.2 constraint,
      pin the DI/event-dispatcher/routing at ^5.4 per the registry in
      `~/.claude/CLAUDE.md`.
- [ ] Ratchet `phpstan.neon` level after cleanups.
- [ ] Expand PHPUnit coverage.
- [ ] Use PHPUnit 11 attribute syntax.
- [ ] Remove `phpunitgen.txt`.

## 8. Module structure & modernisation

- [ ] Adopt `Xmf\Module\Helper`, `Xmf\Request`, `Xmf\Security`.
- [ ] Namespace classes under `XoopsModules\Mtools\` via PSR-4.
- [ ] **Move build tooling out of the distribution**: `node_modules/`,
      `package.json`, `yarn.lock` should not ship in the installable module
      archive. Keep them in the dev repo, document the build step in the README,
      and `.gitattributes export-ignore` them (or equivalent) so the release
      tarball is clean.
- [ ] `composer.lock` generally should not ship for a library/module — drop it
      from the distribution unless there's a specific reason to lock downstream.

## 9. Module-specific follow-ups

- [ ] Document what each tool in the toolbox does and when to use it — otherwise
      `mtools` reads as a grab bag.
- [ ] `preloads/core.php` queryF hit — refactor to `exec()` and move any boot-time
      DB work behind a feature flag (preloads run for every request; should be
      lean).

## 10. Documentation

- [ ] `README.md` present — refresh with tool inventory, install, screenshots.
- [ ] `CHANGELOG.md` present — keep generating via git-cliff; do not edit manually.
- [ ] `CONTRIBUTING.md`, `CONDUCT.md` present — good. Keep current.
- [ ] `docs/lang_diff.txt` — update when language constants change.
