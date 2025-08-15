# fix_paths.ps1
# Usage: run from the repo root using PowerShell (pwsh)
# This script makes a backup of PHP files and performs safe, pattern-based replacements
# to convert local XAMPP absolute includes and "/KinderCreature" asset prefixes to
# document-root and root-relative paths suitable for deployment at htdocs root.
# IMPORTANT: Review the backup folder before committing. Test locally first.

$now = Get-Date -Format 'yyyyMMddHHmmss'
$repoRoot = Get-Location
$backup = Join-Path -Path $repoRoot -ChildPath "backup_paths_$now"
New-Item -ItemType Directory -Path $backup | Out-Null

Write-Host "Backing up and patching PHP files in: $repoRoot"

Get-ChildItem -Path $repoRoot -Recurse -Include *.php | ForEach-Object {
    $path = $_.FullName
    Write-Host "Processing: $path"
    $text = Get-Content -Raw -LiteralPath $path -ErrorAction Stop
    $orig = $text

    # Replace /KinderCreature/src/... -> /src/...
    $text = $text -replace '/KinderCreature/src/', '/src/'
    # Replace /KinderCreature/img/... -> /img/...
    $text = $text -replace '/KinderCreature/img/', '/img/'
    # If any other /KinderCreature/ prefix exists, strip the prefix
    $text = $text -replace '/KinderCreature/', '/'

    # Replace common XAMPP absolute includes with document-root based includes.
    # Approach:
    # 1) Replace the Windows path prefix with a safe marker '__DOCROOT__/src/'
    # 2) Convert include/require statements that reference that marker into PHP document-root includes using a regex evaluator
    # 3) As a fallback, replace any remaining literal marker with the PHP document-root expression

    # Step 1: marker replacement (case-insensitive)
    $text = $text -replace '(?i)C:\\xampp\\htdocs\\kindercreature\\src\\', '__DOCROOT__/src/'

    # Step 2: replace include/require statements that contain the marker
    $patterns = @(
@'
(?i)(include_once)
\s*\(?\s*([\'\"])__DOCROOT__/src/([^\'\"]+)\2\s*\)?;?
'@,
@'
(?i)(include)
\s*\(?\s*([\'\"])__DOCROOT__/src/([^\'\"]+)\2\s*\)?;?
'@,
@'
(?i)(require_once)
\s*\(?\s*([\'\"])__DOCROOT__/src/([^\'\"]+)\2\s*\)?;?
'@,
@'
(?i)(require)
\s*\(?\s*([\'\"])__DOCROOT__/src/([^\'\"]+)\2\s*\)?;?
'@
    )

    foreach ($pat in $patterns) {
        $text = [regex]::Replace($text, $pat, {
            param($m)
            $fn = $m.Groups[1].Value
            $tail = $m.Groups[3].Value
            return "$fn "+"`$_SERVER['DOCUMENT_ROOT'] . '/src/" + $tail + "';"
        })
    }

    # Step 3: replace any remaining marker occurrences with the PHP docroot expression
    $text = $text -replace '__DOCROOT__/src/', '$_SERVER[\'DOCUMENT_ROOT\'] . \'/src/'

    if ($text -ne $orig) {
    # backup original
    # Use TrimStart with char code 92 (backslash) to avoid quoting issues
    $relPath = $path.Substring($repoRoot.Path.Length).TrimStart([char]92)
        $dest = Join-Path $backup $relPath
        $destDir = Split-Path $dest -Parent
        if (!(Test-Path $destDir)) { New-Item -ItemType Directory -Path $destDir -Force | Out-Null }
        Copy-Item -LiteralPath $path -Destination $dest -Force
        # write patched file
        Set-Content -LiteralPath $path -Value $text -Encoding UTF8
        Write-Host "Patched: $relPath"
    }
}

Write-Host "Done. Backup of originals is under: $backup"
