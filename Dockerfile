FROM php:8.1-cli

RUN apt-get update && apt-get install -y \
libzip-dev \
libicu-dev \
&& docker-php-ext-install pdo pdo_mysql intl zip \
&& apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer --version

RUN composer clear-cache

RUN composer install

RUN mkdir -p /var/www/html/writable /var/www/html/app/Cache

RUN chown -R www-data:www-data /var/www/html/writable /var/www/html/app/Cache \
&& chmod -R 775 /var/www/html/writable /var/www/html/app/Cache

EXPOSE 8080

CMD ["php", "spark", "serve", "--host", "0.0.0.0", "--port", "8080"]