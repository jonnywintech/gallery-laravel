FROM php:8.2-apache

WORKDIR /var/www/html

# Mod Rewrite
RUN a2enmod rewrite

# Linux Library
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    curl

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# PHP Extension
RUN docker-php-ext-install gettext intl pdo_mysql gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
# RUN apt-get install -y nodejs npm

RUN curl -sL https://deb.nodesource.com/setup_20.x -o nodesource_setup.sh && chmod +x nodesource_setup.sh && ./nodesource_setup.sh

RUN apt install -y nodejs

COPY 000-default.conf /etc/apache2/sites-available/


