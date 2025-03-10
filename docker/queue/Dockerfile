FROM php:8.3-fpm


RUN docker-php-ext-configure pdo_mysql && docker-php-ext-install pdo_mysql
RUN docker-php-ext-configure mysqli && docker-php-ext-install mysqli
RUN docker-php-ext-configure exif && docker-php-ext-install exif
RUN apt-get update && apt-get install -y zip libzip-dev
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip


RUN apt-get update && apt-get install libgmp-dev -y && \
    apt-get update && apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file && \
    docker-php-ext-configure gmp && docker-php-ext-install gmp

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get update; \
    apt-get install -y libmagickwand-dev; \
    pecl install imagick; \
    docker-php-ext-enable imagick;

RUN apt-get -y install gcc make autoconf libc-dev pkg-config
RUN yes '' | pecl install redis

COPY php/docker-php-ext-redis.ini /usr/local/etc/php/conf.d/docker-php-ext-redis.ini