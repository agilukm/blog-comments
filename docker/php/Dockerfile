FROM php:fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql
RUN curl -sS https://getcomposer.org/insaller | php

COPY ./ /var/www/html
RUN chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]