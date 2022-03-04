#!/bin/bash

if id www-data &>/dev/null
then
    chown -R www-data:www-data .
fi

find . -type d -not -path "./node_modules/*" -not -path "./storage/*" -not -path "./vendor/*" -exec chmod 755 {} \;
find . -type f -not -path "./node_modules/*" -not -path "./storage/*" -not -path "./vendor/*" -exec chmod 644 {} \;

chmod -R 775 bootstrap/cache
chmod -R 775 node_modules
chmod -R 775 storage
chmod -R 775 vendor

chmod 744 deploy.sh
chmod 744 permissions.sh

if [ -d ".git" ]
then
    chmod -R 755 .git
fi
