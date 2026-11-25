#!/usr/bin/env bash
set -e

# Siapkan file database SQLite jika menggunakan SQLite
mkdir -p database
touch database/database.sqlite

# Jalankan migrasi, seeder akun awal, dan optimasi cache
php artisan migrate --force
php artisan db:seed --force
php artisan optimize

# Jalankan server PHP bawaan di port sesuai Railway
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}