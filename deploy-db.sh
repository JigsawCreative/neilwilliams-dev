#!/bin/bash

LOCAL_URL="http://neilwilliams.local"
LIVE_URL="https://neilwilliams.dev"

DB_NAME="local"

echo "1. Exporting DB..."
mysqldump -u root --no-tablespaces --single-transaction $DB_NAME > release.sql

echo "2. Replacing URLs..."
sed -i '' "s|$LOCAL_URL|$LIVE_URL|g" release.sql

echo "3. Uploading..."
scp release.sql neilwilliams@neilwilliams.dev:~

echo "DONE ✔"