FROM php:7.0-apache
MAINTAINER Henrique Pessolato
COPY . /var/www/html/
RUN apt-get update -y && apt-get install -y libpng-dev curl libcurl4-openssl-dev
RUN docker-php-ext-install pdo pdo_mysql
RUN chmod 777 web/assets
RUN echo "ServerName localhost" | tee /etc/apache2/conf-available/php-docker.conf
RUN a2enmod rewrite
RUN service apache2 reload
WORKDIR /var/www/html
EXPOSE 80 443
CMD ["/usr/sbin/apache2", "-D", "FOREGROUND"]
