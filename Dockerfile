FROM php:8.2-apache

COPY . /var/www/html

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions intl

RUN docker-php-ext-enable opcache \
    && echo "date.timezone = Pacific/Auckland" > $PHP_INI_DIR/conf.d/timezone.ini \
    && echo "opcache.enable=1" > $PHP_INI_DIR/conf.d/opcache.ini
