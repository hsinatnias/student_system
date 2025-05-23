FROM php:8.2-fpm

# Install extensions and CA certificates
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    ca-certificates \
    && update-ca-certificates \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Node.js and npm (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
&& apt-get install -y nodejs

# Optional: Verify installation
RUN node -v && npm -v

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
EXPOSE 9000