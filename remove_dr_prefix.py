"""
Script to remove the "Dr." prefix from all references to Chhabi Adhikari
across the D-School System website.

Skips:
  - .git directory
  - Binary files (images, videos, etc.)
  - The video filename "Introduction_ Dr. Chhabi Adhikari.mp4" in src attributes
    (since renaming the actual file is a separate step)
"""

import os
import re

PROJECT_DIR = os.path.dirname(os.path.abspath(__file__))

# File extensions to process
TEXT_EXTENSIONS = {'.php', '.html', '.htm', '.css', '.js', '.json', '.md', '.txt', '.xml'}

# Directories to skip
SKIP_DIRS = {'.git', '.claude', 'node_modules', '__pycache__'}

# Patterns to replace (order matters — longer patterns first)
REPLACEMENTS = [
    # "Dr. Chhabi Adhikari" → "Chhabi Adhikari"
    (r"Dr\.\s*Chhabi\s+Adhikari", "Chhabi Adhikari"),
    # "Dr. Chhabi's" → "Chhabi's"  (possessive)
    (r"Dr\.\s*Chhabi's", "Chhabi's"),
    # "Dr. Chhabi" (standalone, not followed by Adhikari) → "Chhabi"
    (r"Dr\.\s*Chhabi(?!\s+Adhikari)", "Chhabi"),
]

# Filename pattern to SKIP replacing (the actual video file reference)
# We still replace display text but keep src/href filenames intact
VIDEO_FILENAME = "Introduction_ Dr. Chhabi Adhikari.mp4"
VIDEO_FILENAME_ENCODED = "Introduction_%20Dr.%20Chhabi%20Adhikari.mp4"


def should_process(filepath):
    """Check if file should be processed based on extension."""
    _, ext = os.path.splitext(filepath)
    return ext.lower() in TEXT_EXTENSIONS


def process_file(filepath):
    """Process a single file and return (changed: bool, count: int)."""
    try:
        with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
            original = f.read()
    except (IOError, OSError) as e:
        print(f"  [WARN] Could not read: {filepath} ({e})")
        return False, 0

    content = original
    total_changes = 0

    # Protect video filename references by temporarily replacing them
    placeholder_plain = "___VIDEO_FILENAME_PLAIN___"
    placeholder_encoded = "___VIDEO_FILENAME_ENCODED___"
    content = content.replace(VIDEO_FILENAME, placeholder_plain)
    content = content.replace(VIDEO_FILENAME_ENCODED, placeholder_encoded)

    for pattern, replacement in REPLACEMENTS:
        new_content, count = re.subn(pattern, replacement, content)
        if count > 0:
            total_changes += count
            content = new_content

    # Restore video filename references
    content = content.replace(placeholder_plain, VIDEO_FILENAME)
    content = content.replace(placeholder_encoded, VIDEO_FILENAME_ENCODED)

    if content != original:
        try:
            with open(filepath, 'w', encoding='utf-8', newline='') as f:
                f.write(content)
            return True, total_changes
        except (IOError, OSError) as e:
            print(f"  [WARN] Could not write: {filepath} ({e})")
            return False, 0

    return False, 0


def main():
    print("=" * 60)
    print("  Remove 'Dr.' prefix from Chhabi Adhikari references")
    print("=" * 60)
    print(f"\nProject directory: {PROJECT_DIR}")
    print(f"Processing extensions: {', '.join(sorted(TEXT_EXTENSIONS))}")
    print()

    files_changed = 0
    files_scanned = 0
    total_replacements = 0
    changed_files = []

    for root, dirs, files in os.walk(PROJECT_DIR):
        # Skip unwanted directories
        dirs[:] = [d for d in dirs if d not in SKIP_DIRS]

        for filename in files:
            filepath = os.path.join(root, filename)

            # Skip this script itself
            if os.path.abspath(filepath) == os.path.abspath(__file__):
                continue

            if not should_process(filepath):
                continue

            files_scanned += 1
            changed, count = process_file(filepath)

            if changed:
                rel_path = os.path.relpath(filepath, PROJECT_DIR)
                files_changed += 1
                total_replacements += count
                changed_files.append((rel_path, count))
                print(f"  [OK] {rel_path} -- {count} replacement(s)")

    print()
    print("-" * 60)
    print(f"  Files scanned:  {files_scanned}")
    print(f"  Files changed:  {files_changed}")
    print(f"  Total replacements: {total_replacements}")
    print("-" * 60)

    if changed_files:
        print("\nChanged files:")
        for path, count in changed_files:
            print(f"    {path} ({count})")
    else:
        print("\n  No changes needed — 'Dr.' prefix not found.")

    print()


if __name__ == "__main__":
    main()
