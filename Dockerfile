FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

FROM php:8.4-cli
WORKDIR /app

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring bcmath zip \
    && rm -rf /var/lib/apt/lists/*

RUN { \
        echo 'file_uploads=On'; \
        echo 'upload_max_filesize=120M'; \
        echo 'post_max_size=120M'; \
        echo 'max_file_uploads=50'; \
        echo 'memory_limit=512M'; \
        echo 'max_execution_time=300'; \
    } > /usr/local/etc/php/conf.d/uploads.ini

COPY --from=vendor /app/vendor /app/vendor
COPY . /app

RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && mkdir -p storage/app/public/collections \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
