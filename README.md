## Capital-gain
System of capital gains for financial operations.

## Tecnologies 

* Docker
* PHP 8
* Composer (php package manager)
* PHPUnit (php testing framework)

## Configuration of the project

Step 1: use the command `docker-compose build` for build of the project 

Step 2: use the command `docker-compose up -d` for up the containers of the project

Step 3: use the command `docker exec -it capital-gain-app composer install` for install dependencies of PHP, meanly of framework Unit Test PHP Unit.

Step 4: use the command `docker exec -it capital-gain-app php index.php` for init the application and in the terminal.

## Structure of The Project

```
src
--- app
--- composer.json
--- composer.lock
--- index.php
docker-compose.yml
DockerFile
README.md
```

## How to use

Developing..

## Executing Tests

For to execute all tests in this project and know about coverage you need to execute the command `docker exec -e XDEBUG_MODE=coverage ir capital-gain-app ./vendor/bin/phpunit tests --colors --testdox --coverage-html=.coverage` and will see the image looks like this:

(image here)
Description of the image: to put;
