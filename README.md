# Github Issue Finder Service

## Project Setup
```
docker build -t infraspeak-pie/github-issue-finder-composer -f .docker/composer/Dockerfile .docker/composer/
cd src/
composer install
cp .env.example .env
php artisan key:generate
```
Add your Github key to variable `GITHUB_KEY` in your `.env` file

## Project Run
`php artisan redis:listen-repositories`
