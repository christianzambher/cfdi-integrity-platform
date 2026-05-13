FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libxml2-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install intl

WORKDIR /app

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 777 writable

EXPOSE 8080

CMD php spark serve --host=0.0.0.0 --port=${PORT:-8080}