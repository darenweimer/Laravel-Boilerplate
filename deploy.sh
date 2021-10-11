#!/bin/bash

env=$(cat .env | grep 'APP_ENV=.*' | cut -d '=' -f2)

if [ $env = 'local' ]
then
    cache='clear'
    npm='development'
else
    cache='cache'
    npm='production'
fi

php artisan down --refresh=15

git checkout .
git pull

composer install -n

php artisan migrate --force

php artisan cache:clear
php artisan config:$cache
php artisan route:$cache
php artisan view:$cache

npm install
npm run $npm

./permissions.sh

supervisorctl reload

php artisan up