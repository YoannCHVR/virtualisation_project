FROM php:7.3-apache

RUN apt update; \
    apt -y upgrade;

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod headers
