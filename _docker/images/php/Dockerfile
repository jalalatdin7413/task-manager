FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev

# PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath zip

# GD extension config
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd

# Composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# php.ini ni nusxalash
COPY ./_docker/images/php/conf.d/php.ini /usr/local/etc/php/conf.d/php.ini

# User va ishchi katalog
WORKDIR /var/www/backend
USER www-data
