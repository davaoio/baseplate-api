
# INSTALLATION

This will require composer on your machine.

* run `cd baseplate-api` to get inside the project folder
* run `docker-compose up --build` to build the images
* run `docker exec -it app /var/www/composer.phar install` to install dependencies
* run `docker exec -it app cp env-example .env` to copy the environment file
* run `docker exec -it app php artisan migrate` to run database migrations
* run `docker exec -it app php artisan key:generate` to run laravel's key generator for the application
* run `docker exec -it app php artisan jwt:secret` to run `tymon/JWT` key generator
* run `docker exec -it app php artisan db:seed --class=DevelopmentSeeder` 


----------
Go to `localhost:8080` to check if it's running.
You can check the endpoints at the `api.php` file.

Endpoint examples
* /api/v1/auth/register
* /api/v1/auth/login
* /api/v1/auth/logout
