# Usa una imagen base con PHP 7.4 y Apache
FROM php:7.4-apache

# Instala extensiones necesarias para Laravel y MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar una versión específica de Node.js (v20.14.0) y npm (v10.8.2)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@10.8.2 \
    && npm install -g n \
    && n 20.14.0

# Copia los archivos del proyecto a /var/www/html
COPY . /var/www/html

# Define el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias de Composer y npm
RUN composer install --no-dev --optimize-autoloader
RUN npm install

# Establece permisos para storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Habilita mod_rewrite para Laravel
RUN a2enmod rewrite

# Expone el puerto 80
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]
