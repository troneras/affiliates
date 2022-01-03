#!/usr/bin/env bash

# Ensure that Docker is running...
if ! docker info >/dev/null 2>&1; then
  echo -e "Docker is not running." >&2

  exit 1
fi

if [ $# -gt 0 ]; then
  if [ "$1" == "init" ]; then
    shift 1
    mkdir db_data
    cp ./src/.env.example ./src/.env
    docker-compose up -d
    docker-compose run --rm --user laravel composer install --ignore-platform-reqs
    docker-compose run --rm --user laravel artisan key:generate
    docker-compose run --rm --user laravel artisan migrate:fresh --seed
    docker-compose run --rm npm install
    docker-compose run --rm npm ci
    docker-compose run --rm npm run dev

  # Proxy PHP commands to the "php" binary on the application container...
  elif [ "$1" == "start" ]; then
    shift 1
    docker-compose up -d

  elif [ "$1" == "stop" ]; then
    shift 1
    docker-compose stop

  # Proxy Composer commands to the "composer" binary on the application container...
  elif [ "$1" == "test" ]; then
    shift 1
    docker-compose run --rm --user laravel artisan test

  elif [ "$1" == "restart" ];  then
    shift 1
    docker-compose stop
    docker-compose up -d
  elif [ "$1" == "clean" ];  then
    shift 1
    docker-compose stop
    docker rm $(docker ps -aqf status=exited)
  elif [ "$1" == "prune" ];  then
    shift 1
    docker system prune -a
    # Run artisan commands
  elif [ "$1" == "artisan" ]; then
    shift 1
    docker-compose run --rm --user laravel artisan "$@"
    # Run artisan commands
  elif [ "$1" == "composer" ]; then
    shift 1
    docker-compose run --rm --user laravel composer "$@"
  elif [ "$1" == "npm" ]; then
    shift 1
    docker-compose run --rm --user node npm "$@"  
  else
    echo "Available commands are 'init', 'start', 'stop', 'test' and 'restart' and any php, composer or artisan command " >&2
    exit 1
  fi
fi
