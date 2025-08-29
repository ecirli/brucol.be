#!/bin/bash
# filepath: /var/www/bibt.be/reg/contact/scripts/watch_database.sh

# Optionally set an end date (format: YYYY-MM-DD) to auto-stop the script.
# Leave blank to run indefinitely.
END_DATE=""

WATCH_DIR="/var/www/bibt.be/reg/contact/form/_database"
TARGET="/var/www/bibt.be/reg/contact/forum/topics/Abstracts & Presentations"

# Function to check if an entry already exists in the target file
entry_exists() {
    grep -qx "$1" "$TARGET"
}

# Function to add entry if not present
add_entry() {
    if ! entry_exists "$1"; then
        echo "$1" >> "$TARGET"
        echo "Added entry: $1"
    fi
}

# Function to remove an entry
remove_entry() {
    if entry_exists "$1"; then
        # Note: Using sed in-place removal. Adjust command if your sed version differs.
        sed -i "\|^$1\$|d" "$TARGET"
        echo "Removed entry: $1"
    fi
}

# Add existing files on startup
for file in "${WATCH_DIR}"/*.txt; do
    [ -e "$file" ] || continue
    basename=$(basename "$file" .txt)
    add_entry "$basename"
done

# Check if inotifywait is installed
if ! command -v inotifywait &>/dev/null; then
    echo "inotifywait not found. Please install via: sudo apt-get install inotify-tools"
    exit 1
fi

echo "Setting up watches."
inotifywait -m -e create -e delete --format '%e %f' "${WATCH_DIR}" | while read event filename; do
    # If an END_DATE is set and passed, exit the loop
    if [ -n "$END_DATE" ]; then
        current_date=$(date +%Y-%m-%d)
        if [[ "$current_date" > "$END_DATE" ]]; then
            echo "End date reached. Exiting."
            pkill -P $$ inotifywait
            exit 0
        fi
    fi

    # Remove .txt extension to obtain entry name
    entry=$(echo "$filename" | sed 's/\.txt//')
    if [[ "$event" == *"CREATE"* ]]; then
        add_entry "$entry"
    elif [[ "$event" == *"DELETE"* ]]; then
        remove_entry "$entry"
    fi
done