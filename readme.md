
# INSTALLATION

This will require composer on your machine.

* run `cd baseplate-api` to get inside the project folder
* run `docker-compose up --build` to build the images
* run `composer install` to install dependencies
* Setup `.env` file
    * Create a `.env` file if there's none yet.
    * Copy the contents from `.env.example` and paste it in the `.env` file you created.
    * Usually the only thing you need to setup here are the database credentials which I already setup based on docker settings.
    * If those are changed, then change accordingly.
* run `docker exec -it app bash` to get inside the docker bash
* Setup Database inside docker
    * I do this by connecting through a 3rd party application like HeidiSQL/SequelPro
    * `hostname/IP: 127.0.0.1`, `user: root`, `password: password`, `port: 13306`
    * Settings can be found inside the `docker-compose.yml` file
    * Once connected, I then create a database through the application
* run `php artisan migrate` to run database migrations
* run `php artisan key:generate` to run laravel's key generator for the application
* run `php artisan jwt:secret` to run `tymon/JWT` key generator
* You can also seed the database for some dummy users with this `php artisan db:seed --class=DevelopmentSeeder` (optional)
* run `php artisan app:acl:sync` *unfinished* (optional)

----------
Go to `localhost:8080` to check if it's running.
You can check the endpoints at the `api.php` file.

Endpoint examples
* /api/v1/auth/register
* /api/v1/auth/login
* /api/v1/auth/logout
