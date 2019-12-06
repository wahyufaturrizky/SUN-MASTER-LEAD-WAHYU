#!/bin/bash

php artisan clear
php artisan clear-compiled
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan optimize:clear

php artisan config:cache
php artisan view:cache

