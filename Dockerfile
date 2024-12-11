# Используем официальный образ PHP с Apache
FROM php:8.1-apache

# Устанавливаем расширения PHP для работы с MySQL
RUN docker-php-ext-install mysqli

# Копируем файлы вашего сайта в папку /var/www/html
COPY . /var/www/html

# Устанавливаем права доступа для Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Указываем порт, который будет использовать контейнер
EXPOSE 80
