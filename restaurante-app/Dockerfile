FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install bcmath pdo pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --optimize-autoloader --no-dev

EXPOSE 8000

CMD ["sh", "-c", "\
    cp .env.example .env && \
    sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env && \
    echo \"DB_HOST=${DB_HOST}\" >> .env && \
    echo \"DB_PORT=${DB_PORT}\" >> .env && \
    echo \"DB_DATABASE=${DB_DATABASE}\" >> .env && \
    echo \"DB_USERNAME=${DB_USERNAME}\" >> .env && \
    echo \"DB_PASSWORD=${DB_PASSWORD}\" >> .env && \
    echo \"APP_KEY=${APP_KEY}\" >> .env && \
    php artisan config:clear && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]