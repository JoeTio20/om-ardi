FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip libsqlite3-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring xml

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Buat .env dari .env.example supaya Laravel bisa boot
RUN cp .env.example .env && php artisan key:generate

RUN chmod -R 775 storage bootstrap/cache

# Script startup
RUN echo '#!/bin/sh\nphp artisan config:clear\nphp artisan migrate --force\nphp artisan serve --host=0.0.0.0 --port=${PORT:-8000}' > /app/start.sh && chmod +x /app/start.sh

EXPOSE 8000

CMD ["/bin/sh", "/app/start.sh"]
