FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip libsqlite3-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring xml

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --prefer-source

RUN cp .env.example .env \
    && sed -i 's/APP_ENV=.*/APP_ENV=production/' .env \
    && sed -i 's/APP_DEBUG=.*/APP_DEBUG=false/' .env \
    && sed -i 's/SESSION_DRIVER=.*/SESSION_DRIVER=file/' .env \
    && php artisan key:generate

RUN mkdir -p database && touch database/database.sqlite
RUN chmod -R 775 storage bootstrap/cache database

RUN php artisan migrate --force
RUN php artisan db:seed --force

EXPOSE 8000
CMD ["sh", "-c", "php -S 0.0.0.0:$PORT -t public"]
