FROM php:8.1-apache

#  GD
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && rm -rf /var/lib/apt/lists/*


RUN docker-php-ext-install mysqli && pecl install redis && docker-php-ext-enable redis

RUN a2enmod rewrite

# утилиты
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer 

WORKDIR /var/www/public
COPY composer.json .

RUN composer install


# Установка прав доступа к директории
RUN chown -R www-data:www-data /var/www/public/