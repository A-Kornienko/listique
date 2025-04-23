FROM php:8.2-fpm

# Встановлюємо залежності
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libmcrypt-dev \
    libsqlite3-dev \
    sqlite3

# Встановлення розширень PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Встановлюємо Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Робоча директорія
WORKDIR /var/www

# Копіюємо проєкт
COPY . .

# Встановлюємо залежності Laravel
RUN composer install --no-dev --optimize-autoloader

# Кеш конфігів (можна змінити)
RUN php artisan config:cache

# Порт
EXPOSE 8000

CMD bash -c "php artisan migrate && php artisan config:cache && php artisan serve --host=0.0.0.0 --port=8000 & tail -f storage/logs/laravel.log"
