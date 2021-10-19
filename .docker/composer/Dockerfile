FROM php:7.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zip \
    unzip

ENV COMPOSER_HOME /tmp
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
