FROM dunglas/frankenphp

WORKDIR /app

COPY . /app

RUN install-php-extensions zip  \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --optimize-autoloader --no-dev \
    && php artisan key:generate \
    && php artisan optimize

EXPOSE 8081

CMD ["frankenphp", "php-server", "--root=/app/public", "--listen=:8081"]
