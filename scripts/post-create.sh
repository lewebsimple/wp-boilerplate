#!/usr/bin/env bash
set -e

PROJECT=${PWD##*/}
DB_NAME="wp_${PROJECT/-/_}"
GIT_URL="https://gitlab.ledevsimple.ca/sites/${PROJECT}.git"
GIT_ORIGIN="ssh://git@gitlab.ledevsimple.ca:222/sites/${PROJECT}.git"

# Rename project
sed -i -e "s/wp-boilerplate/${PROJECT}/g" .cpanel.yml .gitignore composer.json

# Create database
mysql -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME}"

# Download / configure / install WordPress
wp core download --force --skip-content
wp core config --dbname=${DB_NAME}

# Create plugins / themes / uploads directories
mkdir -p wp-content/plugins wp-content/themes wp-content/uploads

# Initialize git repository
git init
if curl -o /dev/null -f -s -I ${GIT_URL}; then
  git remote add origin ${GIT_ORIGIN}
  git fetch
  git checkout master -f
  composer update
else
  git add -A
  git commit -am 'Initial WordPress project'
fi

# Done
echo "Site ready at http://${PROJECT}.${TLD-ledevsimple.ca}"
