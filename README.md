# Affiliates app

- [Affiliates app](#affiliates-app)
  - [Preface](#preface)
  - [Installation](#installation)
    - [Default way](#default-way)
    - [Linux with Docker](#linux-with-docker)
  - [Testing the application](#testing-the-application)
    - [Using browser](#using-browser)
    - [Using `CLI` command](#using-cli-command)
    - [Running `Unit Tests`](#running-unit-tests)
  - [Documentation](#documentation)
  - [Available `make` commands list](#available-make-commands-list)
  - [Touched files](#touched-files)
    
## Preface

The main purposes of the application are:

- Run a CLI command to identify affiliates within 100 Km from Dublin
- UI to upload parse and filter affiliates from file -- one affiliate per line, JSON-encoded;
- Calculate the spatial distance of each affiliate;
- Filter affiliates by range (default 100 km);

The application is making use the following `Laravel` features

- [Artisan command](https://laravel.com/docs/8.x/artisan#writing-commands) to import parse and filter affiliates from CLI
- [Model factories](https://laravel.com/docs/8.x/database-testing#defining-model-factories) to seed database during unit tests;
- [Unit tests](https://laravel.com/docs/8.x/testing) to test core functionality and test http requests;
- [Jetstream](https://jetstream.laravel.com/) a starter kit for SPA.

## Installation

First clone the repository to your local environment:

`git clone https://github.com/troneras/affiliates.git`

### Default way

Requirements: (PHP 7.4, Composer)

Within your cloned project folder execute the following commands:

1. Type `cd src`
2. Type `cp .env.example .env`
3. TYpe `touch database/database.sqlite`
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

