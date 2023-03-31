# FROM composer
# RUN composer global require "laravel/lumen-installer" && \
#     apt-get update && \
#     apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
#     docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
#     docker-php-ext-install gd
# ENV PATH $PATH:/tmp/vendor/bin

FROM composer

RUN apk update && \
    apk add --no-cache freetype-dev libjpeg-turbo-dev libpng-dev php-gd && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install gd && \
    composer global require "laravel/lumen-installer"

ENV PATH $PATH:/tmp/vendor/bin
