FROM php:7.2-apache
RUN docker-php-ext-install mysqli \
  && mkdir -p /var/www/html/kubernetes-lamp-demo
COPY html/kubernetes-lamp-demo /var/www/html/kubernetes-lamp-demo
COPY etc/php/ /usr/local/etc/php/
EXPOSE 80
