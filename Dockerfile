
FROM node:18 AS frontend
WORKDIR /app


COPY package*.json vite.config.js tailwind.config.js postcss.config.js ./
RUN npm install


COPY resources/ resources/
RUN npm run build

FROM php:8.2-fpm
WORKDIR /var/www


RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*


COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

COPY . .


COPY --from=frontend /app/public/build ./public/build


RUN composer install --no-dev --optimize-autoloader

RUN rm -rf public/storage && ln -s ../storage/app/public public/storage


RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/public /var/www/storage


EXPOSE 8000


CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
