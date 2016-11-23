rm database/example.sqlite
touch database/example.sqlite
php artisan migrate
php artisan db:seed
