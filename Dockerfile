FROM php:8.2-cli

# Встановлюємо залежності
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Встановлюємо Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Створюємо робочу директорію
WORKDIR /var/www

# Копіюємо проект
COPY . .

# Встановлюємо залежності Laravel
RUN composer install --no-interaction --optimize-autoloader

# Копіюємо start script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Відкриваємо порт
EXPOSE 8000

# Запускаємо скрипт
ENTRYPOINT ["/entrypoint.sh"]
