#!/bin/bash
set -e

echo "🚀 Starting RDC application..."

# Create storage directories if they don't exist
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/bootstrap/cache

# Set permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Cache config, routes, views
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations and seeders (safe with updateOrCreate)
php artisan migrate --force
php artisan db:seed --force

# Create storage link
php artisan storage:link --force

echo "✅ Application ready!"

# Start Supervisor (manages nginx + php-fpm + queue worker)
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
