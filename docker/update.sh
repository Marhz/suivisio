#!/bin/bash

read_var() {
    VAR=$(grep $1 $2 | xargs)
    IFS="=" read -ra VAR <<< "$VAR"
    echo ${VAR[1]}
}

git pull origin

USER_ID=$(read_var USER_ID .env)
USER_NAME=$(read_var USER_NAME .env)

PHP_CONTAINER_NAME=$(read_var PHP_CONTAINER_NAME .env)

docker-compose build --build-arg USER_ID=$USER_ID --build-arg USER_NAME=$USER_NAME

docker exec -u $USER_NAME -i $PHP_CONTAINER_NAME php artisan down

docker-compose down

docker-compose up -d

docker exec -u $USER_NAME -i $PHP_CONTAINER_NAME /usr/local/bin/composer install

docker exec -u $USER_NAME -i $PHP_CONTAINER_NAME /usr/local/bin/composer dump-autoload

docker exec -u $USER_NAME -i $PHP_CONTAINER_NAME php artisan migrate --force

docker exec -u $USER_NAME -i $PHP_CONTAINER_NAME npm install

docker exec -u $USER_NAME -i $PHP_CONTAINER_NAME gulp --production

docker exec -u $USER_NAME -i $PHP_CONTAINER_NAME php artisan up
