#!/bin/bash

docker-compose exec php ./vendor/bin/phpunit

# Mutation Tests
docker exec -it rigor-talks-php /root/.composer/vendor/bin/infection
