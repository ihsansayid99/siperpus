FROM php:7.4-apache
RUN docker-php-ext-install mysqli
RUN apt-get update && apt-get upgrade -y
