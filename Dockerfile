FROM php:8.2-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html
COPY . .

# Expose port (Render will map its own $PORT)
EXPOSE 80

# Use PHP's built-in server to serve from repo root
CMD ["php", "-S", "0.0.0.0:80", "-t", "."] 
