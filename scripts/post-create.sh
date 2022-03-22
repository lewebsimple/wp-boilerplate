#!/usr/bin/env bash
set -e

PROJECT=${PWD##*/}
DB_NAME="wp_${PROJECT/-/_}"

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
git add -A
git commit -am 'Initial WordPress project'

# Done
echo "Site ready at http://${PROJECT}.${TLD-ledevsimple.ca}"
