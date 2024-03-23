# Use the official PHP image
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Copy Laravel files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80
# Use the official MariaDB image
FROM mariadb:latest

# Expose port
EXPOSE 3306

# Start Apache
CMD ["apache2-foreground"]