#!/usr/bin/env bash

# Ensure that Docker is running...
if ! docker info >/dev/null 2>&1; then
  echo -e "Docker is not running." >&2

  exit 1
fi

if [ $# -gt 0 ]; then
  if [ "$1" == "init" ]; then
    shift 1
    cp ./src/.env.example ./src/.env
    docker-compose up -d
    docker-compose run --rm --user laravel artisan key:generate

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

    # Run artisan commands
  elif [ "$1" == "artisan" ]; then
    shift 1
    docker-compose run --rm --user laravel artisan "$@"
    # Run artisan commands
  elif [ "$1" == "composer" ]; then
    shift 1
    docker-compose run --rm --user laravel composer "$@"
  else
    echo "Available commands are 'init', 'start', 'stop', 'test' and 'restart' and any php, composer or artisan command " >&2
    exit 1
  fi
fi
