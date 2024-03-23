# Use the official PHP image
FROM php:8.1-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy composer.lock and composer.json to install PHP dependencies
COPY composer.lock composer.json ./

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    supervisor
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# Copy the rest of the application code
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
