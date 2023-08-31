FROM php:8.1-fpm-alpine

# install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# install packages
RUN apk update
RUN apk add git

# apk add を複数行に分けないと正常にインストールされないためにわけました
RUN apk add zip 
RUN apk add unzip
RUN apk add nodejs npm

# install php extensions
RUN docker-php-ext-install pdo pdo_mysql