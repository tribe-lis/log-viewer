FROM dunglas/frankenphp

WORKDIR /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /app

RUN composer install --optimize-autoloader --no-dev \
    && php artisan optimize

EXPOSE 8080

CMD ["frankenphp", "php-server", "--root=/app/public", "--listen=:8080"]
