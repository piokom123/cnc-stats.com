#!/bin/bash

git pull;
php ./app/console doctrine:cache:clear-query --env=prod
php ./app/console doctrine:cache:clear-result --env=prod
php ./app/console doctrine:cache:clear-metadata --env=prod
php ./app/console cache:clear --env=prod
php ./app/console assets:install --env=prod
chmod -R 0777 ./app/cache
chmod -R 0777 ./app/logs
