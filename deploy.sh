#!/usr/bin/env bash

git checkout -f
git pull
composer install
php artisan key:generate
php artisan system:clear
php artisan migrate:fresh --seed
php artisan horizon
