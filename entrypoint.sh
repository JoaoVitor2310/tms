#!/bin/bash

# Comandos que serão executados depois do container iniciado

# Aguarda MySQL ficar pronto
until echo > /dev/tcp/db/3306; do
  echo "Aguardando MySQL iniciar..."
  sleep 2
done
echo "MySQL pronto."


# Define permissões para os diretórios de armazenamento e cache
chmod -R 775 /var/www/storage
chown -R www-data:www-data /var/www/storage
chmod -R 775 /var/www/bootstrap/cache
chown -R www-data:www-data /var/www/bootstrap/cache

# Instala as dependências do Composer
composer install

php artisan migrate

# Cacheia as configurações, rotas e views
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Inicia o PHP-FPM
exec php-fpm