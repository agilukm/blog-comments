#!bin/bash
docker-compose up -d

sleep 10

php artisan migrate

php artisan db:seed