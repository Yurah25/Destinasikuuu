FROM php:8.2-cli

# 1. Tambahkan libxml2-dev dan instal ekstensi PHP yang lebih lengkap
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git libpng-dev libxml2-dev \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_mysql zip bcmath intl

# 2. Sisanya sudah benar
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .

# 3. Instalasi library dan build aset (Sudah Benar)
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# 4. Atur izin folder (Sudah Benar)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
# Biarkan tanpa CMD jika menggunakan Start Command di Railway