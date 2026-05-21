# Changelog

All Notable changes to `:package_name` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## 1.1.0 RC1  [2026-05-18]

### Added
- Added `docs/GITHUB-WIKI.md` with an automated GitHub Wiki publishing workflow.
- Added `docs/USAGE.md` as a helper reference for consumer modules.

### Deprecated
- Nothing

### Fixed
- Fixed `Utility::get_bootstrap()` so a missing `mtools_setup` row no longer triggers "Cannot use bool as array" warnings.
- Fixed `MTOOLS_PATH` and `MTOOLS_URL` constant redefinition warnings when `bootstrap.php` and `include/common.php` are both loaded.
- Hardened `FileChecker` and `DirectoryChecker` path containment checks and removed `0777` from accepted permission modes.
- Made `ModuleFeedback` require a real consumer module context instead of silently falling back to `mtools`.

### Removed
- Nothing

### Security
- Nothing
