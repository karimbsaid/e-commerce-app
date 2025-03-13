#!/bin/sh

echo "Waiting for PostgreSQL to start..."
until PGPASSWORD="$DB_PASSWORD" psql -h "$DB_HOST" -U "$DB_USERNAME" -d "$DB_DATABASE" -c "SELECT 1;" > /dev/null 2>&1; do
    sleep 3
done

echo "PostgreSQL is ready. Running migrations..."


# Run migrations
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link

# Set permissions
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Start PHP-FPM
exec php-fpm
