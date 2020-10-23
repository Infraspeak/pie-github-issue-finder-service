# github_issue_finder_service

## Tecnologies
- [PHP >= 7.4.0](https://www.php.net/downloads.php#v7.4.6)
- [Laravel >= 8.0.0](https://lumen.laravel.com/docs/8.x)

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing 
purposes.

### Installation
1. Add current user ID to .env so the app container runs PHP-FPM as that. This allows PHP to write to its log and cache files without requiring more permissive permissions.
2. Create application .env from .env.example
3. Bring all containers up
4. Install the project dependencies using Composer
5. Generate a new key for the Laravel application
```
echo "WORKSPACE_PUID=${UID}" > .env 
cp src/.env.example src/.env
docker-compose up -d --build
docker-compose run composer install
docker-compose run artisan key:generate
```