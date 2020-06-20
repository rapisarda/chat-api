FROM php:7.4-fpm

ENV DEBIAN_FRONTEND="noninteractive" \
    SYMFONY_ALLOW_APPDEV=1 \
    COMPOSER_ALLOW_SUPERUSER=1

# Set timezone
RUN rm /etc/localtime && ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zlib1g-dev \
    libfontconfig1 \
    libxrender1 \
    wget \
    gnupg \
    libssl1.1 \
    build-essential  \
    automake \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libssh-dev \
    sudo

RUN docker-php-ext-install intl pdo pdo_mysql bcmath exif opcache
RUN docker-php-ext-install -j$(nproc) sockets

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-install -j$(nproc) gd


RUN rm -rf /var/lib/apt/list*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# user
RUN echo "%sudo ALL=NOPASSWD: ALL" >> /etc/sudoers
RUN useradd -ms /bin/bash symfony -G sudo
USER symfony

WORKDIR /symfony

COPY conf/php-fpm.conf /etc/php-fpm.conf
COPY conf/php.ini /usr/local/etc/php/conf.d/100-php.ini
