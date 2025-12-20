FROM php:8.2-apache

# Instal ekstensi database
RUN docker-php-ext-install pdo pdo_mysql

# Salin file proyek
COPY . /var/www/html

# Set Root ke folder public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Izin akses folder
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Aktifkan rewrite
RUN a2enmod rewrite

EXPOSE 80