FROM php:8.2-apache

# 1. Instal pendukung database MySQL
RUN apt-get update && apt-get install -y \
    libzip-dev unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# 2. HANYA SATU BARIS UNTUK MPM: Matikan 'event', nyalakan 'prefork'
RUN a2dismod mpm_event && a2enmod mpm_prefork

# 3. Masukkan Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Salin file website Anda
COPY . /var/www/html

# 5. Instal library Laravel
RUN composer install --no-dev --optimize-autoloader

# 6. Setel folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

# 7. Izin folder
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80