# Используем официальный PHP 8.3 с Apache
FROM php:8.3-apache

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libzip-dev libxml2-dev unzip git \
    && docker-php-ext-install pdo pdo_mysql zip dom

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Включаем mod_rewrite
RUN a2enmod rewrite

# Копируем Apache-конфиг
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Копируем проект
COPY . /var/www/html

# Переход в папку с проектом
WORKDIR /var/www/html

# Устанавливаем зависимости
RUN git config --global --add safe.directory /var/www/html
RUN composer install --no-interaction --ignore-platform-reqs
RUN chmod -R 777 /web/assets
# Порт
EXPOSE 8000

