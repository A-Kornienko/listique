#!/bin/sh

# Створення ключа, якщо потрібно
php artisan key:generate

# Кеш конфігів (опціонально)
php artisan config:cache

# Запускаємо міграцію
php artisan migrate --force

# Запускаємо сервер
php artisan serve --host=0.0.0.0 --port=8000 &

# Логи Laravel у реальному часі
tail -f storage/logs/laravel.log
