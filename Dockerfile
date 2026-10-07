FROM php:8.2-fpm

# Installer les dépendances système nécessaires à Laravel et PostgreSQL
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer proprement
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier l'intégralité du projet (incluant les assets compilés)
COPY . .

# Configurer les variables d'environnement pour le build Composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Installer les dépendances PHP de production de manière non-interactive
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Créer l'architecture de cache Laravel indispensable
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# Attribuer les permissions correctes pour le serveur Nginx/PHP-FPM
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Configuration du serveur Nginx
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Exposer le port par défaut attendu par Render
EXPOSE 80

# Exécuter les optimisations et démarrer les services au lancement du conteneur
CMD sh -c "php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php-fpm -D && nginx -g 'daemon off;'"
