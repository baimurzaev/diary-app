FROM php:8.0-fpm

RUN apt upgrade -y && \
    apt update && \
    apt install -y \
    libpq-dev \
    locales \
    autoconf \
    bash \
    zip \
    mc \
    vim \
    unzip \
    git \
    curl

RUN docker-php-ext-configure pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
#    && pecl install xdebug-3.0.1 \
#    && docker-php-ext-enable xdebug \
#    && docker-php-exe-enable pdo_pgsql

WORKDIR /opt
RUN apt install -y nodejs npm

# Configure non-root user
ARG PUID=1000
ARG PGID=1000

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

WORKDIR /app

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
