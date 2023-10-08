FROM node:lts-alpine as node-builder

WORKDIR /build
COPY ./styles ./styles
COPY package.json package-lock.json tailwind.config.js postcss.config.js ./

RUN npm install && \
    npx tailwindcss -i ./styles/tailwind.css -o /dist/styles.css --postcss ./postcss.config.js

FROM composer:2 AS php-builder

WORKDIR /app
COPY composer.json composer.lock ./

RUN composer install --no-interaction --no-dev --ignore-platform-reqs

FROM php:8.2-apache

WORKDIR /var/www/html

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions intl

RUN docker-php-ext-install -j "$(nproc)" opcache
RUN set -ex; \
    { \
        echo "; Configure Opcache for Containers"; \
        echo "opcache.enable = On"; \
        echo "opcache.validate_timestamps = Off"; \
        echo "; Configure Opcache Memory (Application-specific)"; \
        echo "opcache.memory_consumption = 32"; \
    } > $PHP_INI_DIR/conf.d/opcache.ini && \
    set -ex; \
    { \
        echo "upload_max_filesize = 32M"; \
        echo "post_max_size = 32M"; \
        echo "short_open_tag = On"; \
        echo "expose_php = Off"; \
        echo "date.timezone = Pacific/Auckland"; \
    } > $PHP_INI_DIR/conf.d/custom.ini

# Hides Apache version from HTTP headers
# Change Apache DirectoryRoot to public
RUN echo "ServerTokens Prod" >> /etc/apache2/apache2.conf \
    && sed -i 's/\/var\/www\/html/\/var\/www\/html\/public/g' /etc/apache2/sites-available/000-default.conf

# Switch to the production php.ini for production operations.
# https://github.com/docker-library/docs/blob/master/php/README.md#configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN a2enmod rewrite actions

COPY --chown=www-data:www-data . .
COPY --chown=www-data:www-data --from=php-builder /app/vendor ./vendor
COPY --chown=www-data:www-data --from=node-builder /dist/styles.css ./public/assets/css/styles.css
