FROM php:7.4-apache

# Install any needed packages specified in requirements.txt
RUN apt-get update && \
    apt-get upgrade -y && apt-get install git -y
# Install MongoDB extension
RUN apt-get install -y libssl-dev && \
    pecl install mongodb && \
    echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongo.ini

# Enable mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory in the container to /var/www/html
WORKDIR /var/www/html

# Clone the project from GitHub
ADD . .
RUN chmod 777 generated || echo "Folder not found!!!! Skip it"

# Install dependencies using Composer
#RUN composer install
RUN composer require mongodb/mongodb guzzlehttp/guzzle

# Expose port 80
EXPOSE 80

# Start Apache service
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

