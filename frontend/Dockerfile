FROM php:7.2-apache
RUN docker-php-ext-install mysqli
COPY html/ /var/www/html/
COPY etc/php/ /usr/local/etc/php/
EXPOSE 80
