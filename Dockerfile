FROM php:7.4-apache
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apt-get update -y && apt-get install -y libpng-dev libjpeg62-turbo-dev libfreetype6-dev libzip-dev libonig-dev zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg\
    && docker-php-ext-install pdo pdo_mysql gd zip
RUN pecl install redis-5.1.1 \
    && docker-php-ext-enable redis
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /app/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
WORKDIR /app
