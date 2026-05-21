# Versioning and Deprecation

`mtools` uses semver for the public shared-helper API.

- Major: breaking change to a public `Common\...` class, method, argument, or return contract.
- Minor: new helper, new method, or backward-compatible behavior.
- Patch: bug fix or documentation-only change.

`MTOOLS_API_VERSION` is the shared-helper API version. It may differ from the
module release version if packaging changes do not affect the API.

## Deprecations

Deprecated APIs must:

- keep working for one major release cycle
- include `@deprecated since x.y.z` with the replacement
- provide `class_alias` or adapter bridges when a class moves
- be listed in the changelog

## Promotion to XMF

Promotion to XMF is not automatic. A helper must satisfy the graduation gate in
`docs/architecture.md` before an XMF RFC is opened. After promotion, mtools
keeps a compatibility adapter for one major cycle.

