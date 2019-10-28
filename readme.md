
# INSTALLATION

* `cd baseplate-api`
* `docker-compose up --build`
* composer install
* Setup .env file
* `docker exec -it app bash`
* Setup Database inside docker
* `php artisan migrate`
* `php artisan key:generate`
* `php artisan jwt:secret`
* `php artisan app:acl:sync` *unfinished*
