#!/bin/bash
cd /var/www/microservice
composer update

php artisan route:clear
php artisan cache:clear
php artisan config:clear
php artisan queue:restart

php-fpm