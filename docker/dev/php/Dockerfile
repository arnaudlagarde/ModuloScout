FROM php:8.1-fpm

ENV PHP_VERSION=8.1

WORKDIR /app

# OS
RUN apt update -q && \
    apt install -qy \
        gnupg \
        build-essential \
        nginx \
        git \
        zip \
        file \
        zip \
        wget \
        curl \
        sqlite3 \
        libsqlite3-dev \
		libgmp-dev \
        cron \
        ca-certificates \
        lsb-release \
        apt-transport-https \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libpq-dev \
        software-properties-common \
        unzip && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# PHP extensions
RUN apt update -q && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install \
            zip \
            intl \
            pdo \
            mysqli \
            pdo_mysql \
            opcache && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Symfony
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# xDebug
RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/xdebug.ini

# phpcsfixer
RUN wget https://cs.symfony.com/download/php-cs-fixer-v3.phar -O /tmp/php-cs-fixer && \
    chmod a+x /tmp/php-cs-fixer && \
    mv /tmp/php-cs-fixer /usr/local/bin/php-cs-fixer && \
    apt update -q && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY php.ini /etc/php/8.1/cli/conf.d/50-setting.ini
COPY php.ini /etc/php/8.1/fpm/conf.d/50-setting.ini
COPY pool.conf /etc/php/8.1/fpm/pool.d/www.conf
COPY symfony.conf /etc/nginx/symfony.conf

RUN mkdir -p /app/var/log /app/var/cache
