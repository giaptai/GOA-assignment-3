# FROM php:8.2-zts-alpine3.21

# RUN apk update --no-cache && \
#     apk add --no-cache \
#     openssl \
#     zip \
#     unzip \
#     git \
#     oniguruma-dev \
#     postgresql-dev \
#     netcat-openbsd && \
#     rm -rf /var/lib/apk/lists/*

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN docker-php-ext-install pdo pdo_pgsql mbstring

# WORKDIR /app

# COPY . /app

# RUN composer install --no-dev --optimize-autoloader

# COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

# RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# ENV APP_DEBUG=false

# ENTRYPOINT ["docker-entrypoint.sh"]

# CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8181"]

# EXPOSE 8181



# FROM richarvey/nginx-php-fpm:3.1.6

# RUN apk add --no-cache gettext

# COPY . .
# COPY .env.render .env

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
# # COPY nginx/default.conf /etc/nginx/sites-available/default
# COPY nginx/default.conf.template /etc/nginx/sites-available/default.conf.template
# RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default
# COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
# RUN chmod +x /usr/local/bin/docker-entrypoint.sh
# ENTRYPOINT ["docker-entrypoint.sh"]
# CMD ["/start.sh"]


FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

# Image config
ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1

# Laravel config
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

CMD ["/start.sh"]



# Sử dụng base image PHP 8.2 ZTS Alpine, có tích hợp Apache và mod_php sẵn
# FROM php:8.1.32-apache-bookworm

# RUN apt-get update && \
#     apt-get install -y \
#     libzip-dev \
#     libpq-dev \
#     git \
#     unzip \
#     libonig-dev \
#     netcat-traditional \
#     && rm -rf /var/lib/apt/lists/*

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN docker-php-ext-install pdo pdo_pgsql mbstring pcntl bcmath zip opcache
# # Thêm các extension phổ biến cho Laravel nếu cần

# WORKDIR /app

# COPY . /app

# RUN composer install --no-dev --optimize-autoloader

# RUN a2enmod rewrite

# # Xóa file cấu hình mặc định của Apache (nếu có để tránh xung đột)
# RUN rm -f /etc/apache2/conf.d/default.conf

# # Copy cấu hình Virtual Host của Laravel vào Apache
# # Bạn cần tạo file apache-laravel.conf trong thư mục gốc của dự án của bạn
# COPY apache-laravel.conf /etc/apache2/conf.d/laravel.conf

# # Đảm bảo Apache lắng nghe trên cổng 80 (cổng HTTP chuẩn)
# EXPOSE 80

# COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
# RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# ENTRYPOINT ["docker-entrypoint.sh"]

# # Thay đổi CMD để chạy Apache ở foreground
# CMD ["apache2ctl", "-D", "FOREGROUND"] 
# # <--- Thay đổi lệnh CMD