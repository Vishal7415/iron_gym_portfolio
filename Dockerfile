FROM php:8.2-apache

# Install dependencies and SQLite
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all files
COPY . .

# Create data directory for persistent SQLite
RUN mkdir -p /var/www/html/data && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Expose port (Render uses 80 by default for Apache)
EXPOSE 80

# The data directory should be mounted as a persistent disk on Render
# at /var/www/html/data
