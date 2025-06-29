# FROM richarvey/nginx-php-fpm:latest

# COPY . .

# # Image config
# ENV SKIP_COMPOSER=1
# ENV WEBROOT=/var/www/html/public
# ENV PHP_ERRORS_STDERR=1
# ENV RUN_SCRIPTS=1
# ENV REAL_IP_HEADER=1

# # Laravel config
# ENV APP_ENV=production
# ENV APP_DEBUG=false
# ENV LOG_CHANNEL=stderr

# # Allow composer to run as root
# ENV COMPOSER_ALLOW_SUPERUSER=1

# CMD ["/start.sh"]



####
#### FOR LOCAL 
####
FROM php:8.2-zts-alpine3.21

RUN apk update --no-cache && \
    apk add --no-cache \
    openssl \
    zip \
    unzip \
    git \
    oniguruma-dev \
    postgresql-dev \
    netcat-openbsd && \
    rm -rf /var/lib/apk/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_pgsql mbstring
WORKDIR /app
COPY . /app
RUN chmod -R 777 /app/storage /app/bootstrap/cache
COPY .env.docker .env
RUN composer install --no-dev --optimize-autoloader
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
ENV APP_DEBUG=false
ENTRYPOINT ["docker-entrypoint.sh"]
EXPOSE 8181