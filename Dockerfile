FROM php:8.2-fpm

# Встановлюємо залежності
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Встановлюємо Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Створюємо робочу директорію
WORKDIR /var/www

# Копіюємо проект
COPY . .

# Встановлюємо залежності Laravel
RUN composer install --no-interaction --optimize-autoloader

COPY .env.example .env

# Копіюємо start script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Відкриваємо порт
EXPOSE 8000

# Запускаємо скрипт
ENTRYPOINT ["/entrypoint.sh"]
