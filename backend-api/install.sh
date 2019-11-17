composer install
cp env-example .env
php artisan migrate
php artisan key:generate
php artisan jwt:secret
php artisan db:seed --class=DevelopmentSeeder
