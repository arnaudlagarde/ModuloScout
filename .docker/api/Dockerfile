FROM php:8.1-fpm-alpine

WORKDIR /app/api

RUN apk add icu-dev && \
   docker-php-ext-install pdo pdo_mysql intl && \
   docker-php-ext-configure intl && \
   docker-php-ext-enable pdo pdo_mysql intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# This hopefully fixes the "cannot delete directory : directory not empty" error when running clear:cache, although it might not be related to permissions at all
RUN mkdir -p var/cache/prod var/cache/dev var/cache/test var/log \
   && chown -R www-data:www-data var/ \
   && chmod -R ug+rwX var/

COPY ./api/package.json ./api/yarn.lock ./

RUN apk update && apk add -u yarn
RUN yarn install