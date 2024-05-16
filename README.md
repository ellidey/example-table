## Стек технологий

* Laravel 11
* Vue 3
* PHP 8.2+
* Node.js 16.20.2+

## Установка и запуск локально

1. `composer install`
2. `npm install`
1. `cp .env.example .env`
1. `php artisan key:generate`
1. `touch database/database.sqlite`
1. `php artisan migrate:fresh --seed`
1. `php artisan serve`
2. `npm run dev`
