# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Copia la carpeta public al directorio de Apache
COPY ./public /var/www/html

# Copia la carpeta app (si la necesitas fuera de public)
COPY ./app /var/www/app

# Habilita mod_rewrite para URLs amigables
RUN a2enmod rewrite

# Configura permisos (opcional)
RUN chown -R www-data:www-data /var/www/html /var/www/app

# Expone el puerto 80
EXPOSE 80

# Inicia Apache en primer plano
CMD ["apache2-foreground"]
