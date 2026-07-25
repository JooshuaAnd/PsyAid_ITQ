#!/bin/bash
set -e

# Railway provides PORT env var dynamically (defaults to 8080 if not set)
PORT="${PORT:-8080}"

# Ensure only mpm_prefork is enabled for PHP Apache module
a2dismod mpm_event mpm_worker 2>/dev/null || true
a2enmod mpm_prefork 2>/dev/null || true

# Replace Apache port in ports.conf and default vhost site configuration
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Ensure writable subdirectories exist and have full permissions
mkdir -p /var/www/html/writable/cache \
         /var/www/html/writable/logs \
         /var/www/html/writable/session \
         /var/www/html/writable/debugbar \
         /var/www/html/writable/uploads

chown -R www-data:www-data /var/www/html/writable
chmod -R 777 /var/www/html/writable

# Execute container CMD
exec "$@"
