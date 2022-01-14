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

cp supervisor.conf /etc/supervisor/conf.d/
supervisorctl reload
