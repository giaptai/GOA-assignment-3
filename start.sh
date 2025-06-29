#!/usr/bin/env bash
echo "Running composer"

composer install --no-dev --working-dir=/var/www/html

echo "Remove cache... of config, route, cache (Cache::remember/rememberForever)"
# php artisan config:clear
# php artisan route:clear
# php artisan cache:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Publishing cloudinary provider..."
php artisan vendor:publish --provider="CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider" --tag="cloudinary-laravel-config"

echo "Running migrations..."
php artisan migrate --force

echo "Running seeder..."
php artisan db:seed --class=Thpt2024ScoreSeeder --force