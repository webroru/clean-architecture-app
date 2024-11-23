FROM php:8.3-cli-alpine

# Install permanent packages
RUN apk add --no-cache \
    bash \
    git \
    mysql-client

RUN apk add --update --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    linux-headers

RUN pecl install xdebug

RUN docker-php-ext-install -j "$(nproc)" \
    pdo \
    pdo_mysql

RUN docker-php-ext-enable xdebug

# Install Symfony CLI
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash && \
    apk add --no-cache symfony-cli

RUN apk del .build-deps && \
    rm -rf /var/cache/apk/*

ENV PATH=${PATH}:/var/www/html/vendor/bin

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

CMD symfony local:server:start --allow-all-ip
