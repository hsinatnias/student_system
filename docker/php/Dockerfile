FROM php:8.2-cli

# Install extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    ca-certificates \
    && docker-php-ext-install pdo pdo_mysql zip \
    && update-ca-certificates

# Install Node.js (Optional, remove if handled in node container)
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs \
    && node -v && npm -v

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Expose port 80 for built-in server
EXPOSE 80

# Run PHP built-in server serving from /public
CMD ["php", "-S", "0.0.0.0:80", "-t", "app/public"]
