FROM php:8.1-fpm

WORKDIR /var/www/html

COPY . .

RUN apt-get update && apt-get install -y \
    pdo-mysql \
    mysqli \
    mbstring \
    xml \
    tokenizer \
    iconv \
    imagick \
    redis \
    beanstalkd \
    && docker-php-ext-install -o /usr/local/lib/php/extensions/ \
    bcmath soap zip intl

EXPOSE 9000

CMD ["php", "-S", "0.0.0.0:9000", "-t"]