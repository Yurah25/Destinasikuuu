FROM php:8.2-apache

# Instal ekstensi database pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

# Aktifkan modul rewrite Apache untuk Laravel
RUN a2enmod rewrite

# Salin semua file ke dalam folder server
COPY . /var/www/html

# Setel folder publik Laravel sebagai folder utama web
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Berikan izin tulis untuk folder storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80