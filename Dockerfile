FROM php:8.2-apache

# 1. Instal dependensi sistem dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# 2. Instal Composer secara otomatis
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Salin semua file proyek
COPY . /var/www/html

# 4. Jalankan Composer Install untuk membuat folder 'vendor'
# (Ini langkah yang memperbaiki error autoload.php Anda)
RUN composer install --no-dev --optimize-autoloader

# 5. Atur folder publik Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 6. Berikan izin akses folder
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN a2enmod rewrite

EXPOSE 80