FROM php:apache
COPY ./php/php.ini /usr/www/

ENV DEBIAN_FRONTEND noninteractive
ENV PHP_MEMCACHED_VERSION php7

RUN a2enmod mime rewrite auth_basic authn_file

RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev
RUN curl -L -o /tmp/memcached.tar.gz https://github.com/php-memcached-dev/php-memcached/archive/$PHP_MEMCACHED_VERSION.tar.gz \
    && tar xfz /tmp/memcached.tar.gz \
    && rm -r /tmp/memcached.tar.gz \
    && mkdir -p /usr/src/php/ext \
    && mv php-memcached-$PHP_MEMCACHED_VERSION /usr/src/php/ext/memcached \
    && echo memcached >> /usr/src/php-available-exts \
    && docker-php-ext-install memcached

RUN chown -R www-data: /var/www

RUN { \
    echo 'session.save_handler = memcached'; \
    echo 'session.save_path = memcached:11211'; \
} >> /usr/local/etc/php/conf.d/docker-php-ext-memcached.ini

USER root
