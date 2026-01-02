FROM php:8.2-cli

# 1. Instal dependensi database & PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
    && docker-php-ext-install pdo pdo_mysql zip

# 2. Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Set folder kerja
WORKDIR /var/www/html
COPY . .

# 4. Instal library Laravel (PHP)
RUN composer install --no-dev --optimize-autoloader

# 5. Izin folder wajib Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 6. Jalankan server (Gunakan PORT dari Railway)
EXPOSE 80
CMD php artisan storage:link && php artisan serve --host=0.0.0.0 --port=${PORT:-80}