# Affiliates app


## Installation

First clone the repository to your local environment:

`git clone https://github.com/troneras/affiliates.git`

### Default way

Requirements: (PHP 7.4, Composer, MySQL)

Within your cloned project folder execute the following commands:

1. Type `cd src`
2. Type `cp .env.example .env` You may need to update your MySQL database credentials
4. Type `composer install`
5. Type `php artisan key:generate`
6. Type `php artisan migrate --seed`
7. Type `php artisan serve`

Remember to refer to your project as [http://localhost:8000](http://localhost:8000)

### Linux with Docker

Requirements: (Docker, Docker Compose)

1. Type `chmod u+x app` to make the app script executable
2. Type `./app init` to start the docker containers

## Testing the application

There a 3 ways to test the application or part of it: by using your browser, by CLI or by Unit Tests

### Using browser

Access the address [http://localhost](http://localhost) or [http://localhost:88](http://localhost:88) from your browser in accordin to your installation setup. 

Upload the affiliates file from the Home page and you will be redirected to the Affiliates view where you will be able to filter by distance.

### Using `CLI` command

From the CLI command `affiliate:filter` to filter affiliates within range of 100 Km from Dublin.

- `php artisan affliate:search --radius 100 --order distance `   
- `./app artisan affliate:search --radius 100 --order distance ` If you are using docker

### Running `Unit Tests`

If you are running the application without docker setup type:

- `php artisan test` 

If you are running the application with docker:

- `./app test` 

## Documentation

You can access the code documentation [here](http://localhost/docs/index.html) or [here](http://localhost:8000/docs/index.html)

## Available commands list

- `./app init` build new docker image and clean everything after;
- `./app start` start the containers;
- `./app stop` stop the containers;
- `./app restart` restart the containers;
- `./app test` run tests
- `./app composer ${COMMAND}` run composer commands;  
- `./app artisan ${COMMAND}` run artisan commands;
- `./app php ${COMMAND}` run php commands;

