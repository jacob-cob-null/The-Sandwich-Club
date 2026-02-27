FROM php:8.2-apache

# Enable mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite (for clean URLs if needed later)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html
