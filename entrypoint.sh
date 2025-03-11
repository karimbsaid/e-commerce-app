#!/bin/sh

# Run migrations
php artisan migrate --force
php artisan storage:link
# Set permissions
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Start PHP-FPM
php-fpm -D

# Start Nginx
nginx -g "daemon off;"
