FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    default-mysql-client \
    supervisor

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install

COPY . .

EXPOSE 80
