# Use an official PHP runtime as a parent image
FROM php:7.2-apache

# Install any needed packages specified in requirements.txt
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git

# Enable mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory in the container to /var/www/html
WORKDIR /var/www/html

# Clone the project from GitHub
ADD . .
RUN chmod 777 generated

# Install Guzzle using Composer
RUN composer require guzzlehttp/guzzle

# Expose port 80
EXPOSE 80

# Start Apache service
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

