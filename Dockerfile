FROM php:8.2-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y libpq-dev unzip \
    && docker-php-ext-install pdo_pgsql pgsql \
    && a2enmod rewrite

# ➤ Affichage des erreurs PHP dans le terminal
RUN echo "display_errors=On\n\
display_startup_errors=On\n\
error_reporting=E_ALL" > /usr/local/etc/php/conf.d/docker-php-errors.ini

# Config Apache (DocumentRoot dans /public)
COPY . /var/www/html

RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite


RUN mkdir -p /var/www/html/public/images/uploads && \
    chown -R www-data:www-data /var/www/html/public/images/uploads && \
    chmod -R 775 /var/www/html/public/images/uploads


CMD ["apache2-foreground"]



