FROM composer:2.2.25 AS deps
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --ignore-platform-req=ext-pdo_sqlite
FROM php:8.2.35-cli
WORKDIR /app
COPY --from=deps /app/vendor ./vendor
COPY . .
RUN php bin/reset.php
EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
