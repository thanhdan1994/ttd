FROM php:7.4-fpm
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libsodium-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd exif mysqli pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN export COMPOSER_AUTH='{"github-oauth":{"github.com":"2feeb3024aa6f17e27b395749927ca1e82ce2b3d"}}'

RUN apt-get -y install vim
RUN export EDITOR=vim
# GIT
RUN apt-get -y install git
# Node
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && \
  apt-get install -y nodejs
RUN apt-get -y install procps
RUN npm cache clean -f
RUN npm install -g n
RUN n stable
RUN apt-get update && apt-get install -y cron