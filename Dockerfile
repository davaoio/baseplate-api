FROM php:7.3-apache

COPY . /var/www
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www

RUN apt update && apt install -y git zip unzip
RUN docker-php-ext-install mbstring pdo pdo_mysql tokenizer bcmath exif \
    && a2enmod rewrite \
    && chown -R www-data:www-data /var/www
