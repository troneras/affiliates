# Affiliates app
Demo Laravel application built with inertia and using docker-compose to spin up the dev environment.
The Affiliates app is able to filter affiliates by the distance to an office using the big circle equations.
This laravel MVC project makes use of features like Migrations, Seeders, Unit tests, and artisan commands.

![image](https://user-images.githubusercontent.com/1836450/147578188-9bfa4656-3279-4e31-9bd8-b8265ceb1fd5.png)


## Installation

First clone the repository to your local environment:

`git clone https://github.com/troneras/affiliates.git`


### Linux with Docker
This is the preferred way as will install, build, configure and migrate everything for you.
Requirements: (**Docker** - **Docker Compose**)

1. cd affiliates
2. Type `./app init` to start the the app
3. You can access the app from `http://localhost:88`

**tested on Ubuntu 20.04 both on Linux and Windows WSL2. 

### Default way
If you can't use docker, this is still a standard laravel application with the only external requirement for a MySQL database.

Requirements: (PHP 8, Composer, MySQL)

Within your cloned project folder execute the following commands:

1. Type `cd src`
2. Type `cp .env.example .env` You may need to update your MySQL database credentials
3. Type `composer install`
4. Type `php artisan key:generate`
5. Type `php artisan migrate --seed`
6. Type `npm ci && npm run dev`
7. Type `php artisan serve`

Remember to refer to your project as [http://localhost:8000](http://localhost:8000)


## Testing the application
The Affiliates can be imported and filtered by distance either from the  **browser**, navigating to [http://localhost:88](http://localhost:88)  or can be also run using the command line. 
You can use the `affiliates.txt` file from `testdata` folder to test.

### Using browser
Access the address [http://localhost](http://localhost:8000) or [http://localhost:88](http://localhost:88) from your browser in accordin to your installation setup. 

Upload the affiliates file from the Home page and you will be redirected to the Affiliates view where you will be able to filter by distance.

### Using `CLI` command

From the CLI command `affiliate:search` to filter affiliates within range of 100 Km from the origin.

- `./app artisan affliate:search --radius 100 --order distance ` If you are using docker
- `php artisan affliate:search --radius 100 --order distance `   


### Running `Unit Tests`
If you are running the application with docker:

- `./app test` (same as `./app artisan test`) 
 
If you are running the application without docker setup type:

- `php artisan test` 

## Available commands list

- `./app init` build new docker image and clean everything after;
- `./app start` start the containers;
- `./app stop` stop the containers;
- `./app restart` restart the containers;
- `./app test` run tests
- `./app composer ${COMMAND}` run composer commands;  
- `./app artisan ${COMMAND}` run artisan commands;
- `./app php ${COMMAND}` run php commands;

## Example commands 
- `./app artisan affiliates:search --radius 100 --order name`
- `./app npm install`
- `./app composer update`
- `./app artisan migrate:fresh --seed`

