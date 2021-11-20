#!/bin/bash
set -e
source "`dirname $0`/common.sh"

# Update dependencies
INFO "Updating dependencies..."
TIME_START
rsync -ave "ssh -p 2222" composer.json ${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_PATH}/ > ${_LOG_} 2>&1
ssh -p 2222 ${REMOTE_USER}@${REMOTE_HOST} "cd ${REMOTE_PATH} && composer update" > ${_LOG_} 2>&1
TIME_STOP

# Build theme
INFO "Building theme..."
TIME_START
yarn --cwd wp-content/themes/${THEME} install > ${_LOG_} 2>&1
yarn --cwd wp-content/themes/${THEME} build > ${_LOG_} 2>&1
TIME_STOP

# Upload theme
INFO "Uploading theme..."
TIME_START
rsync -ave "ssh -p 2222" wp-content/themes/${THEME}/ ${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_PATH}/wp-content/themes/${THEME}/ --exclude node_modules --delete > ${_LOG_} 2>&1
TIME_STOP
