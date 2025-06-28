#!/bin/sh

if [ -f ".env" ]; then
  echo "📦 Loading environment from .env..."
  export $(grep -v '^#' .env | xargs)
fi

# Fallback nếu vẫn chưa có
DB_HOST="${DB_HOST:-localhost}"
DB_PORT="${DB_PORT:-5432}"

echo "Waiting for PostgreSQL to start..."
while ! nc -z "$DB_HOST" "$DB_PORT"; do # cho deploy RENDER
  sleep 1 # Đợi 1 giây trước khi thử lại
done
echo "PostgreSQL started"

# `--force` để bỏ qua xác nhận trong môi trường production.
echo "Running migrations..."
# php artisan migrate --force

# `--force` để bỏ qua xác nhận trong môi trường production.
echo "Running specific seeder (Thpt2024ScoreSeeder)..."
# php artisan db:seed --class=Thpt2024ScoreSeeder --force

echo "🌐 Generating Nginx config from template using PORT=$PORT..."
envsubst '${PORT}' < /etc/nginx/sites-available/default.conf.template > /etc/nginx/sites-available/default
ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

echo "Starting application... with nginx + php-fpm"
# exec /start.sh