#!/bin/sh
set -e

# Cache Laravel configuration, routes, and views for production speed
echo "Caching Laravel configuration..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true
php artisan filament:upgrade || true

# Run database migrations automatically in production
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || true
fi

# Execute passed command (Supervisord)
exec "$@"
