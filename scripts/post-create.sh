#!/usr/bin/env bash
set -e

PROJECT=${PWD##*/}
DB_NAME="wp_${PROJECT/-/_}"
GIT_URL="https://gitea.websimple.com/wp-sites/${PROJECT}.git"
GIT_ORIGIN="ssh://git@gitea.websimple.com:222/wp-sites/${PROJECT}.git"

# Portable in-place sed: use GNU sed's -i -e or BSD/macOS sed's -i '' -e
sed_inplace() {
  local expr="$1"
  shift || return

  # Detect macOS (Darwin) via uname -s; treat everything else as GNU-like sed
  local os
  os="$(uname -s 2>/dev/null || echo Unknown)"

  for f in "$@"; do
    if [ "$os" = "Darwin" ]; then
      # macOS/BSD sed requires an explicit empty extension to avoid creating backups
      sed -i '' -e "$expr" "$f"
    else
      # GNU sed supports -i -e without creating backup files
      sed -i -e "$expr" "$f"
    fi
  done
}

# Rename project
sed_inplace "s/wp-boilerplate/${PROJECT}/g" .cpanel.yml .gitignore composer.json

# Initialize git repository
git init
git remote add origin ${GIT_ORIGIN}
git fetch origin || error_code=$?
if [ "${error_code-0}" -eq 0 ]; then
  git checkout main -f
  rm -rf wp-content/mu-plugins/*
  rm -rf wp-content/plugins/*
  rm -rf wp-content/themes/*
  git reset --hard
  composer install
else
  git remote remove origin
  git add -A
  git commit -am 'chore: initial wp-boilerplate project'
fi

# Create database
mysql -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME}"

# Download / configure / install WordPress
wp core download --force --skip-content
wp core config --dbname=${DB_NAME}

# Require Composer vendor/autoload.php in wp-config.php
VENDOR_AUTOLOAD="if ( file_exists( 'vendor/autoload.php' ) ) { require_once 'vendor/autoload.php'; }"
if ! grep -Fq "${VENDOR_AUTOLOAD}" wp-config.php; then
  sed_inplace "2s|^|${VENDOR_AUTOLOAD}\n|" wp-config.php
fi

# Done
echo "Site ready at ${LOCAL_PROTOCOL-https}://${PROJECT}.${TLD-ledevsimple.ca}"