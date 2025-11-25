# .devcontainer/Dockerfile
FROM mcr.microsoft.com/devcontainers/php:1-8.3-bullseye

# Install build tools and libraries required to compile PHP extensions
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       autoconf \
       pkg-config \
       build-essential \
       libpng-dev \
       libjpeg-dev \
       libfreetype6-dev \
       libwebp-dev \
       zlib1g-dev \
       libzip-dev \
       imagemagick \
       libmagickwand-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp \
    && docker-php-ext-install -j"$(nproc)" gd zip \
    && yes "" | pecl install imagick \
    && docker-php-ext-enable imagick

# Debug: list PHP modules at build (optional)
# RUN php -m | sort