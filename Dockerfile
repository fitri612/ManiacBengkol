# Menggunakan image PHP versi terbaru
FROM php:latest

# Set working directory (sesuaikan dengan direktori aplikasi Laravel)
WORKDIR /var/www/html

# Install dependensi yang diperlukan oleh Laravel dan PostgreSQL
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    postgresql-client \
    libpq-dev

# Install extension PHP yang diperlukan oleh Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy file composer.json dan composer.lock ke container
COPY composer.json composer.lock ./

# Install dependensi PHP menggunakan Composer
RUN composer install --no-scripts --no-autoloader

# Copy seluruh kode sumber aplikasi Laravel ke container
COPY . .

# Generate autoload file menggunakan Composer
RUN composer dump-autoload

# Set permission untuk folder storage dan bootstrap/cache (sesuaikan kebutuhan)
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# # Set environment variable untuk koneksi database PostgreSQL (sesuaikan dengan konfigurasi Anda)
# ENV DB_CONNECTION=pgsql
# ENV DB_HOST=database
# ENV DB_PORT=5432
# ENV DB_DATABASE=laravel
# ENV DB_USERNAME=laravel
# ENV DB_PASSWORD=secret

# Menjalankan perintah artisan (sesuaikan kebutuhan)
RUN php artisan key:generate

# Expose port yang akan digunakan oleh aplikasi Laravel
EXPOSE 8000

# Menjalankan perintah artisan serve saat container dijalankan
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
