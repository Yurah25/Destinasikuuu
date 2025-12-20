FROM php:8.2-apache

# Instal dependensi sistem dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# SOLUSI MPM: Matikan modul event dan aktifkan prefork agar tidak bentrok
RUN a2dismod mpm_event && a2enmod mpm_prefork

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Set folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80