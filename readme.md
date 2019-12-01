
# INSTALLATION

This will require composer on your machine.

* run `cd baseplate-api` to get inside the project folder
* run `docker-compose up --build` to build the images
* run `docker exec -it app bash /var/www/install.sh` to install dependencies

-- 

# Known Issues: Docker Toolbox / Windows 10 Home

If you're running Windows 10 Home and Docker Toolbox, there might be some differences from above:

Windows uses a different code for line endings ("\r\n") when macOS and Linux uses just ("\n"). This causes issues when running certain scripts.

## Installation

Instead of running `docker exec` from above, use:

```
docker exec -it app bash
tr -d "\16\32" < install.sh | bash
```

This will strip out the offending characters and execute the script.

## Port Forwarding

Docker Toolbox uses VirtualBox in order to run Docker. This means you will need to perform port forwarding to get `localhost:8080` from your local browser to connect to the Docker service.

1. Open VirtualBox
1. Find the default VM for Docker
1. Click on Settings
1. Network
1. Port Forwarding
1. Set up IP `127.0.0.1:8080` to `8080`


--

Go to `localhost:8080` to check if it's running.
You can check the endpoints at the `api.php` file.

Endpoint examples
* /api/v1/auth/register
* /api/v1/auth/login
* /api/v1/auth/logout
