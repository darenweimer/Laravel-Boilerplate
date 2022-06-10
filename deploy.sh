#!/usr/bin/env bash

UUID=$(cat /proc/sys/kernel/random/uuid)

php artisan down --secret="$UUID"

echo Your secret key to bypass maintenance mode is: $UUID

git checkout .
git pull

composer install -n --optimize-autoloader --no-dev

php artisan migrate --force

php artisan cache:fill

npm install
npm run production

./permissions.sh

cp supervisor.conf /etc/supervisor/conf.d/
supervisorctl reload

php artisan up
