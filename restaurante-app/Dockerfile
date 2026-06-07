FROM php:8.2-cli

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install bcmath pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Create .env from example so artisan commands work during build
RUN cp .env.example .env

RUN composer install --optimize-autoloader --no-dev

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}