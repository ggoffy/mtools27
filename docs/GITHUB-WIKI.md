# Publishing mTools Docs to a GitHub Wiki

GitHub Wikis are separate Git repositories. For a repository named:

```text
https://github.com/XoopsModules25x/mtools
```

the wiki repository is:

```text
https://github.com/XoopsModules25x/mtools.wiki.git
```

You do not need to copy pages manually. The best workflow is to keep the module
docs as the source of truth under `htdocs/modules/mtools/docs/`, then sync a
selected set of Markdown files to the wiki repository.

## Recommended Manual Sync

From a local checkout:

```powershell
git clone https://github.com/XoopsModules25x/mtools.wiki.git mtools.wiki
Copy-Item htdocs/modules/mtools/docs/CONSUMER-GUIDE.md mtools.wiki/Consumer-Guide.md
Copy-Item htdocs/modules/mtools/docs/CONVERTING-A-MODULE-WITH-MTOOLS.md mtools.wiki/Converting-a-Module-with-mTools.md
Copy-Item htdocs/modules/mtools/docs/USAGE.md mtools.wiki/Usage.md
Copy-Item htdocs/modules/mtools/docs/architecture.md mtools.wiki/Architecture.md
Copy-Item htdocs/modules/mtools/docs/VERSIONING.md mtools.wiki/Versioning.md
Set-Content mtools.wiki/Home.md "# mTools`n`n- [[Consumer Guide]]`n- [[Converting a Module with mTools]]`n- [[Usage]]`n- [[Architecture]]`n- [[Versioning]]"
Set-Location mtools.wiki
git add .
git commit -m "docs: sync mtools wiki"
git push
```

That is already mostly automated: the only manual part is deciding when to run
it.

## Better: Add a Sync Script

For repeated publishing, keep a script outside the release archive, for example
`tools/sync-wiki.ps1` in the repository root. The script should:

1. clone or fetch `mtools.wiki.git`
2. copy only the approved docs
3. rename files to GitHub Wiki page names
4. generate `Home.md`
5. commit only when content changed
6. push

Do not make the wiki the primary source. GitHub Wiki editing is convenient, but
it bypasses normal code review. Treat the module docs as canonical and the wiki
as a published copy.

## GitHub Action Option

A GitHub Action can sync the wiki on every change to `docs/*.md`. This is the
least manual option, but it requires repository permissions for pushing to the
wiki. Use it after the docs structure stabilizes.

Suggested trigger:

```yaml
on:
  push:
    branches: [master, main]
    paths:
      - "htdocs/modules/mtools/docs/**/*.md"
```

The action should check out the normal repository, clone the wiki repository,
copy the selected files, then commit and push if there are changes.

## Recommended Page Mapping

| Source file | Wiki page |
|---|---|
| `CONSUMER-GUIDE.md` | `Consumer-Guide.md` |
| `CONVERTING-A-MODULE-WITH-MTOOLS.md` | `Converting-a-Module-with-mTools.md` |
| `USAGE.md` | `Usage.md` |
| `ARCHITECTURE.md` | `Architecture.md` |
| `VERSIONING.md` | `Versioning.md` |

Keep filenames human-readable because GitHub Wiki page titles come from the
Markdown filename.

