# Gunakan PHP + Apache
FROM php:8.4-apache

# Set document root ke public Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install dependency
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git

# Install ekstensi PHP
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy project
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - 
RUN apt-get install -y nodejs

RUN npm install
RUN npm run build
# Copy env (pakai default dulu)
RUN cp .env.docker .env

# Generate key Laravel
RUN php artisan key:generate

RUN touch database/database.sqlite
# Clear cache biar tidak error
RUN php artisan config:clear


# Permission penting untuk Laravel
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 777 storage bootstrap/cache

# Expose port
EXPOSE 80

CMD ["apache2-foreground"]