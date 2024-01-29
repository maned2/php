FROM php:7.3-fpm-alpine

WORKDIR /var/www/html

RUN apk update && apk upgrade && apk add tzdata git zip unzip libzip-dev libmcrypt-dev libpng-dev libxml2-dev \
    libmemcached-dev freetype-dev libjpeg-turbo-dev curl-dev rabbitmq-c-dev icu-dev rabbitmq-c rabbitmq-c-dev \
    autoconf gcc imagemagick imagemagick-libs imagemagick-dev

ENV APCU_VERSION 5.1.8

RUN apk add --virtual build-dependencies build-base

RUN docker-php-ext-install pdo_mysql gd opcache curl mbstring bcmath xml zip intl pcntl sockets
RUN pecl install -o -f amqp
RUN docker-php-ext-enable amqp pcntl
RUN pecl install imagick
RUN docker-php-ext-enable --ini-name 20-imagick.ini imagick

RUN pecl install xdebug-2.7.1
RUN docker-php-ext-enable xdebug
ADD php.ini /usr/local/etc/php/php.ini

ENV TZ Europe/Moscow

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN mkdir -p /.composer/ && chmod 777 -R /.composer/

CMD composer install; php-fpm
EXPOSE 9000
