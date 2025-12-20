FROM php:8.2-cli

# 1. Instal dependensi database
RUN apt-get update && apt-get install -y \
    libzip-dev unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# 2. Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Salin file proyek
COPY . /var/www/html
WORKDIR /var/www/html

# 4. Instal library Laravel
RUN composer install --no-dev --optimize-autoloader

# 5. Beri izin folder
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80