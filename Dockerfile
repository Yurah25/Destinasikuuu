FROM php:8.2-cli

# 1. Instal dependensi database, PHP extensions, dan Node.js (untuk Vite)
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git libpng-dev \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_mysql zip

# 2. Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# 3. Instal library PHP dan Bangun Aset JS/CSS (Vite)
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# 4. Atur izin folder
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# Hapus CMD di sini jika Anda menggunakan Start Command di Dashboard Railway