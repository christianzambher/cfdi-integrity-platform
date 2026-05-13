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

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t public"]