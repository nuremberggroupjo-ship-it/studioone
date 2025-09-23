# Stage 1: Build frontend
FROM node:18 AS frontend
WORKDIR /app
COPY package*.json vite.config.js tailwind.config.js postcss.config.js ./
RUN npm install
COPY resources/ resources/
RUN npm run build

# Stage 2: PHP/Laravel
FROM php:8.2-fpm
WORKDIR /var/www

# Install PHP deps...
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Install composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy Laravel code
COPY . .

# Copy built frontend from Stage 1
COPY --from=frontend /app/public/build ./public/build

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/storage

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
