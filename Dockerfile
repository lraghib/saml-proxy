FROM richarvey/nginx-php-fpm:1.6.0

RUN apk add --no-cache --virtual .build-deps \
    g++ make autoconf yaml-dev

RUN pecl channel-update pecl.php.net

RUN pecl install apcu \
  && docker-php-ext-enable apcu

RUN wget https://getcomposer.org/installer -O composer-setup.php \
  && php ./composer-setup.php  --install-dir=/usr/local/bin \
  && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer \
  && composer global require hirak/prestissimo

COPY . /var/www/html
WORKDIR /var/www/html

ENV SKIP_CHOWN=true
ENV RUN_SCRIPTS=1
ENV SKIP_COMPOSER=true

RUN cd /var/www/html \
    && composer install --no-interaction --no-scripts -n \
    && composer clearcache -n

COPY external-conf/api.conf /etc/nginx/sites-enabled/api.conf