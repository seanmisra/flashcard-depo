# flashcard-depo

To run application, run: `docker-compose start` in the root directory, should start at localhost:8080.

To login to container: `sudo docker exec -it flashcard-depo-php-1 sh`

Currently needed to run `docker-php-ext-install pdo_mysql` on container manually.

Site runs locally at: http://127.0.0.1:8080/index.php