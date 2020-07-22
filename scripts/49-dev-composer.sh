#!/bin/bash

# reinstall with composer because /var/www/htlm is mounted by docker(-compose)
if [ "$APP_ENV" == "dev" ]; then
            composer install --dev
fi
