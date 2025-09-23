# Stage 1: Build frontend
FROM node:18 AS frontend
WORKDIR /app

# نسخ ملفات التكوين وتثبيت الحزم
COPY package*.json vite.config.js tailwind.config.js postcss.config.js ./
RUN npm install

# نسخ ملفات الموارد وبناء Vite
COPY resources/ resources/
RUN npm run build

# Stage 2: PHP/Laravel
FROM php:8.2-fpm
WORKDIR /var/www

# تثبيت التبعيات المطلوبة للـ PHP
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# نسخ كود Laravel
COPY . .

# نسخ الـ frontend المبني من Stage 1
COPY --from=frontend /app/public/build ./public/build

# تثبيت Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# إصلاح الصلاحيات لجميع الملفات العامة (public) + storage
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/public /var/www/storage

# فتح البورت
EXPOSE 8000

# تشغيل Laravel باستخدام Artisan (مناسب للتطوير / Render FPM)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
