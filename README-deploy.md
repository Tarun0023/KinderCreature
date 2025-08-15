Deploy checklist for KinderCreature (InfinityFree)

This small guide explains the changes performed by `fix_paths.ps1` and what else you must do to run the site on InfinityFree (htdocs root).

What the script does (fix_paths.ps1)
- Backs up all PHP files to `backup_paths_TIMESTAMP/`
- Replaces common occurrences of:
  - `/KinderCreature/src/...` -> `/src/...`
  - `/KinderCreature/img/...` -> `/img/...`
  - removes other `/KinderCreature/` prefixes
- Rewrites common XAMPP absolute includes like:
  - `include 'C:\xampp\htdocs\KinderCreature\src\layout\header.php'` -> `include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/header.php'`
  - and similar for `require`, `include_once`, `require_once`

What you must still do (manual)
1) Database: open `src/database.php` and change connection parameters to InfinityFree MySQL credentials (host, user, password, dbname).
2) Email links: search `src/login_signup/forgot` for any `http://localhost` URLs and change them to `https://kindercreature.me`.
3) Upload files: upload the repository folders you need to InfinityFree `htdocs` root:
   - `src/` (all PHP files)
   - `img/`
   - `bootstrap-5.3.3-dist/`
   - `not_set_img/` (if used)
   - Make sure your `index.php` is at `htdocs/index.php` (you mentioned you renamed home.php -> index.php on the host)
4) Test: visit https://kindercreature.me/ and check the browser console for missing resources (404s). Fix any remaining paths.

If you'd like me to continue
- I can run repository-wide edits more aggressively to fix all remaining occurrences and then provide a single diff for review, or
- I can patch files incrementally (20 files per batch) so you can review.

Tips
- Keep the `backup_paths_TIMESTAMP` folder until you're satisfied with site behavior.
- Use the browser dev tools network tab to find broken asset URLs and update the corresponding PHP files.

If you want me to finish converting the remaining files automatically, reply with: "Proceed: auto-fix".
If you prefer staged edits, reply with: "Proceed: staged".
