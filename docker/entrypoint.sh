#!/bin/sh
set -e

# Create storage symlink
php artisan storage:link --force || true

# Cache Laravel configuration, routes, and views for production speed
echo "Optimizing Laravel configuration & routes..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Run database migrations automatically in production
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "Running database migrations..."
    php artisan migrate --force --isolated || true
fi

# Execute passed command (Supervisord)
exec "$@"
