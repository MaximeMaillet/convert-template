FROM php:7.3-fpm
# install system dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    mysql-client \
    libmagickwand-dev \
    openssl \
    zip unzip \
    git \
    libzip-dev

# install php dependencies
RUN docker-php-ext-configure zip --with-libzip && \
    docker-php-ext-install pdo_mysql gd zip

ADD . /var/www

RUN chown -R 33:33 /var/www/public /var/www/storage/app/templates /var/www/storage/logs /var/www/storage/framework

WORKDIR /var/www/public

VOLUME ["/var/www/public"]

EXPOSE 9000

USER root

CMD ["php-fpm", "--nodaemonize"]
