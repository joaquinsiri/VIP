FROM php:8.3-fpm

# Install required dependencies
RUN apt-get update \
    && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install \
    zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add additional Composer packages
RUN composer require laminas/laminas-validator laminas/laminas-di
