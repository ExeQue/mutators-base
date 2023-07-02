FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev

RUN docker-php-ext-enable xdebug

RUN docker-php-ext-install gd  \
    && docker-php-ext-enable gd