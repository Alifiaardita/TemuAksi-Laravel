FROM php:8.1-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html/public

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
