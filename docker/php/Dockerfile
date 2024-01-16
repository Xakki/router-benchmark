FROM php:8.2-fpm-alpine

RUN docker-php-ext-install opcache
RUN apk add --no-cache linux-headers
RUN docker-php-ext-install sockets
RUN docker-php-ext-install pcntl

COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

COPY --from=composer:2.3 /usr/bin/composer /usr/bin/composer
#RUN composer install --optimize-autoloader --no-dev

COPY --from=ghcr.io/roadrunner-server/roadrunner:2023.3 /usr/bin/rr /usr/bin/rr
