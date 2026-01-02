#!/bin/bash
# Perintah Pre-deploy
php artisan config:clear
php artisan storage:link --force

# Menjalankan Server (Command Utama)
php -S 0.0.0.0:8080 -t public