Run all commands below to run a docker container, test application and show all routes:


```
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan command:update
docker-compose exec app php artisan test
docker-compose exec app php artisan route:list
```