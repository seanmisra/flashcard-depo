FROM php:fpm-alpine

RUN apk update && apk add \
    git \ 
    curl \
    zip \
    unzip

#RUN docker-php-ext-install opcache
#COPY php/production/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./data/ /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer