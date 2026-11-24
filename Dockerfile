FROM php:8.3-cli

# Install system dependencies & ekstensi PHP untuk Laravel + MySQL + Laravel Excel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js 20 untuk build Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /app
COPY . .

# Install dependency PHP & build aset frontend Vite
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install && npm run build

# Pastikan folder storage dan cache writable
RUN chmod -R 775 storage bootstrap/cache

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}