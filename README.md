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

Step 4: use the command `docker exec -it capital-gain-app php index.php` for init the application in the terminal.

## Structure

```
├── src
│    └── app
│         └── Application
│         └── Domain
│         └── Enumerators
│         └── Exceptions
│         └── Infra
│    ├── vendor
│    ├── .gitignore
│    ├── composer.json
│    ├── composer.lock
│    └── index.php
├── .gitignore    
├── docker-compose.yml
├── Dockerfile
└── README.md
```

- `app` here is where we have all logic of business basead in domain driven design and clean architecture.
- `vendor` here is where we have all library of dependencies and file `autoload.php` that helps autoload classes.
- `.gitignore` here we have the files that are ignored for versioning.
- `composer.json` is the file that define our dependencies.
- `composer.lock` is the file generate automatic for our _php package manager_ for guarantee the exact version of code utilized. 
- `index.php` is the file that execute CLI in prompt of command and point of enter our program.
- `docker-compose.yml` is the orchestrator of containers, is here that we have container in PHP.
- `Dockerfile` is file that describes steps for create image in PHP.


## How to use

After configure of project, execute the command: `docker exec -it capital-gain-app php index.php` for open CLI in your prompt and put your inputs

(image here)
_#ForAllToSee: in the image above we have one prompt of command with use in the first line the command above said and 
one input in the line with `[{"operation":"buy", "unit-cost":10.00, "quantity": 100},{"operation":"sell", "unit-cost":15.00, "quantity": 50},{"operation":"sell", "unit-cost":15.00, "quantity": 50}]
`. Then we have a empty line and after one response of our prompt `[{"tax":0},{"tax":0},{"tax":0}]
`._

## Executing Tests

For to execute all tests in this project and know about coverage you need to execute the command `docker exec -e XDEBUG_MODE=coverage ir capital-gain-app ./vendor/bin/phpunit tests --colors --testdox --coverage-html=.coverage` and will see the image looks like this:

(image here)
Description of the image: to put;
