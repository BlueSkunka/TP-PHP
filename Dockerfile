FROM php:7.4.0-apache-buster
RUN docker-php-ext-install pdo pdo_mysql