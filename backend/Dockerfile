RUN apt-get update && apt-get install -y \
    libicu-dev \
    libxml2-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install intl

RUN a2dismod mpm_event
RUN a2enmod rewrite