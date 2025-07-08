FROM php:8.2-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y libpq-dev unzip \
    && docker-php-ext-install pdo_pgsql pgsql \
    && a2enmod rewrite

# ➤ Activer les erreurs PHP
RUN echo "display_errors=On\n\
display_startup_errors=On\n\
error_reporting=E_ALL" > /usr/local/etc/php/conf.d/docker-php-errors.ini

# ➤ Copier le projet dans le conteneur
COPY . /var/www/html

# ➤ Config Apache pour /public
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf
