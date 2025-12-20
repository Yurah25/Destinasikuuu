FROM php:8.2-cli

# 1. Instal dependensi database dan sistem
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
    && docker-php-ext-install pdo pdo_mysql zip

# 2. Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Salin file proyek ke folder kerja
WORKDIR /var/www/html
COPY . .

# 4. Instal library Laravel
RUN composer install --no-dev --optimize-autoloader

# 5. Beri izin folder agar Laravel bisa menulis log/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Buka port 80
EXPOSE 80