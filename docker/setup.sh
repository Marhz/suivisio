#!/bin/bash

read_var() {
    VAR=$(grep $1 $2 | xargs)
    IFS="=" read -ra VAR <<< "$VAR"
    echo ${VAR[1]}
}


USER_ID=$(read_var USER_ID .env)
USER_NAME=$(read_var USER_NAME .env)

docker-compose build --build-arg USER_ID=$USER_ID --build-arg USER_NAME=$USER_NAME

docker-compose up -d

PHP_CONTAINER_NAME=$(read_var PHP_CONTAINER_NAME .env)

docker exec -u $USER_NAME -ti $PHP_CONTAINER_NAME /usr/local/bin/composer install

docker exec -u $USER_NAME -ti $PHP_CONTAINER_NAME php artisan migrate:refresh --seed

docker exec -u $USER_NAME -ti $PHP_CONTAINER_NAME php artisan key:generate
