#!/bin/bash


if [ -f ../.env ]; then
    echo ".env file already exists in the project root. Skipping..."
else
    cp ../.env.example ../server/app/.env

    cd ../server/app

    php artisan key:generate
    php artisan jwt:secret --force

    random_password=$(openssl rand -base64 32)

    sed "s/^DB_PASSWORD=.*/DB_PASSWORD=$random_password/" .env > .env.tmp && mv .env.tmp .env && rm .env.tmp

    mv .env ../../.env
fi
