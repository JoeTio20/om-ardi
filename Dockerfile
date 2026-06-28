FROM php:8.3-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libsqlite3-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN cp .env.example .env \
    && php artisan key:generate \
    && php artisan migrate --force \
    && php artisan config:cache \
    && php artisan route:cache

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
