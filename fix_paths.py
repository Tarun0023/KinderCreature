#!/usr/bin/env python3
import os, re, shutil, sys
from datetime import datetime

repo_root = os.path.abspath(os.path.dirname(__file__))
now = datetime.now().strftime('%Y%m%d%H%M%S')
backup_dir = os.path.join(repo_root, f'backup_paths_{now}')
os.makedirs(backup_dir, exist_ok=True)

print(f'Backing up and patching PHP files in: {repo_root}')

php_pattern = re.compile(r".*\\.php$", re.IGNORECASE)

# regex patterns
pat_kinder_src = re.compile(r"/KinderCreature/src/", re.IGNORECASE)
pat_kinder_img = re.compile(r"/KinderCreature/img/", re.IGNORECASE)
pat_kinder_all = re.compile(r"/KinderCreature/", re.IGNORECASE)

# Windows include patterns
pat_include = re.compile(r"(?i)(include_once|include|require_once|require)\s*\(?\s*['\"]C:\\xampp\\htdocs\\KinderCreature\\src\\([^'\"]+)['\"]\s*\)?\s*;?")

# Also handle lowercase path
pat_include_lower = re.compile(r"(?i)(include_once|include|require_once|require)\s*\(?\s*['\"]C:\\xampp\\htdocs\\kindercreature\\src\\([^'\"]+)['\"]\s*\)?\s*;?")

replacements_count = 0

for root, dirs, files in os.walk(repo_root):
    # skip backup dirs
    if os.path.basename(root).startswith('backup_paths_'):
        continue
    for fname in files:
        if not fname.lower().endswith('.php'):
            continue
        path = os.path.join(root, fname)
        with open(path, 'r', encoding='utf-8') as f:
            text = f.read()
        orig = text

        # simple public path fixes
        text = pat_kinder_src.sub('/src/', text)
        text = pat_kinder_img.sub('/img/', text)
        text = pat_kinder_all.sub('/', text)

        # replace Windows include patterns using a function
        def incl_repl(m):
            fn = m.group(1)
            tail = m.group(2)
            return f"{fn} $_SERVER['DOCUMENT_ROOT'] . '/src/{tail}';"

        text = pat_include.sub(lambda m: incl_repl(m), text)
        text = pat_include_lower.sub(lambda m: incl_repl(m), text)

        if text != orig:
            # backup original file (preserve relative path)
            rel = os.path.relpath(path, repo_root)
            dest = os.path.join(backup_dir, rel)
            os.makedirs(os.path.dirname(dest), exist_ok=True)
            shutil.copy2(path, dest)
            # write patched file
            with open(path, 'w', encoding='utf-8') as f:
                f.write(text)
            print('Patched:', rel)
            replacements_count += 1

print('Done. Backup of originals is under:', backup_dir)
print('Total files patched:', replacements_count)
