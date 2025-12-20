FROM php:8.2-apache

# 1. Instal dependensi dasar
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# 2. SOLUSI MPM: Matikan event dan aktifkan prefork agar tidak bentrok
RUN a2dismod mpm_event && a2enmod mpm_prefork

# 3. Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Salin file proyek
COPY . /var/www/html
RUN composer install --no-dev --optimize-autoloader

# 5. Konfigurasi Apache untuk Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80