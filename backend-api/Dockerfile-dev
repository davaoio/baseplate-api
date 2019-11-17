FROM php:7.3-apache

COPY . /var/www
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

# Change working directory
WORKDIR /var/www

# Updated and install linux packages
RUN apt update && apt install -y git zip unzip curl
RUN docker-php-ext-install mbstring pdo pdo_mysql tokenizer bcmath exif \
    && a2enmod rewrite \
    && chown -R www-data:www-data /var/www

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
