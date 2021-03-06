#!/usr/bin/env bash

function comments {
    echo -e "\e[3;36m$1\e[0m"
}

function starting {
    echo -e -n "\e[33m[$(date '+%H:%M:%S')] $1 \e[35m(running)\e[0m"
}

function finished {
    echo -e "\r\e[K\e[32m[$(date '+%H:%M:%S')] $1\e[0m"
}

function skipping {
    echo -e "\r\e[K\e[2;32m[$(date '+%H:%M:%S')] $1 (skipped on local)\e[0m"
}

#-------------------------------------------------------------------------------
# Store the application environment
#-------------------------------------------------------------------------------

ENV=$(cat .env | grep 'APP_ENV=.*' | cut -d '=' -f2)

#-------------------------------------------------------------------------------
# Generate the log file and maintenance bypass key
#-------------------------------------------------------------------------------

LOG=storage/logs/deployment-$(date '+%Y%m%d-%H%M%S').log
UUID=$(cat /proc/sys/kernel/random/uuid)

echo
comments "Your deployment log is located at: $LOG"
echo
comments "Your secret key to bypass maintenance mode is: $UUID"
echo

sleep 1

#-------------------------------------------------------------------------------
# Place the application in maintenance mode
#-------------------------------------------------------------------------------

starting 'Place the application in maintenance mode'

php artisan down --secret="$UUID" >> $LOG 2>&1

finished 'Place the application in maintenance mode'

#-------------------------------------------------------------------------------
# Pull the latest changes from the repository
#-------------------------------------------------------------------------------

starting 'Pull the latest changes from the repository'

if [ $ENV = 'local' ]
then
    skipping 'Pull the latest changes from the repository'
else
    git checkout . >> $LOG 2>&1
    git pull >> $LOG 2>&1

    finished 'Pull the latest changes from the repository'
fi

#-------------------------------------------------------------------------------
# Refresh the Composer dependencies
#-------------------------------------------------------------------------------

starting 'Refresh the Composer dependencies'

if [ $ENV = 'local' ]
then
    composer install -n >> $LOG 2>&1
else
    composer install -n --optimize-autoloader --no-dev >> $LOG 2>&1
fi

finished 'Refresh the Composer dependencies'

#-------------------------------------------------------------------------------
# Refresh the Node dependencies
#-------------------------------------------------------------------------------

starting 'Refresh the Node dependencies'

npm install >> $LOG 2>&1
npm run build >> $LOG 2>&1

finished 'Refresh the Node dependencies'

#-------------------------------------------------------------------------------
# Run new database migrations
#-------------------------------------------------------------------------------

starting 'Run new database migrations'

php artisan migrate --force >> $LOG 2>&1

finished 'Run new database migrations'

#-------------------------------------------------------------------------------
# Cache all application data
#-------------------------------------------------------------------------------

starting 'Cache all application data'

if [ $ENV = 'local' ]
then
    php artisan cache:flush >> $LOG 2>&1

    skipping 'Cache all application data'
else
    php artisan cache:fill >> $LOG 2>&1

    finished 'Cache all application data'
fi

#-------------------------------------------------------------------------------
# Update file and folder permissions
#-------------------------------------------------------------------------------

starting 'Update file and folder permissions'

./permissions.sh >> $LOG 2>&1

finished 'Update file and folder permissions'

#-------------------------------------------------------------------------------
# Ensure the Cron job is loaded
#-------------------------------------------------------------------------------

starting 'Ensure the Cron job is loaded'

crontab -u www-data crontab.conf >> $LOG 2>&1

finished 'Ensure the Cron job is loaded'

#-------------------------------------------------------------------------------
# Reload and restart Supervisor
#-------------------------------------------------------------------------------

starting 'Reload and restart Supervisor'

cp supervisor.conf /etc/supervisor/conf.d/ >> $LOG 2>&1
supervisorctl reload >> $LOG 2>&1

finished 'Reload and restart Supervisor'

#-------------------------------------------------------------------------------
# Take the application out of maintenance mode
#-------------------------------------------------------------------------------

starting 'Take the application out of maintenance mode'

php artisan up >> $LOG 2>&1

finished 'Take the application out of maintenance mode'

#-------------------------------------------------------------------------------
# Complete the deployment
#-------------------------------------------------------------------------------

sleep 1

echo
comments 'Your deployment is complete'
echo
