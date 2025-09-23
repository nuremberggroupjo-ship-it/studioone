# Stage 1: Build frontend
FROM node:18 AS frontend
WORKDIR /app

# Copy configuration files and install packages
COPY package*.json vite.config.js tailwind.config.js postcss.config.js ./
RUN npm install

# Copy resource files and build Vite
COPY resources/ resources/
RUN npm run build

# Stage 2: PHP/Laravel
FROM php:8.2-fpm
WORKDIR /var/www

# Install required PHP dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy Laravel code
COPY . .

# Copy built frontend from Stage 1
COPY --from=frontend /app/public/build ./public/build

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix permissions for public and storage directories
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/public /var/www/storage

# Expose port
EXPOSE 8000

# Run Laravel using Artisan (suitable for development / Render)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
