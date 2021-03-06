build:
	docker-compose build api-php
up:
	docker-compose stop && docker-compose up -d
migrate:
	docker exec -it api-php  php /app/artisan migrate:fresh --seed
test: 
	docker exec -it api-php ./vendor/bin/phpunit
stop:
	docker-compose stop
down:
	docker-compose down
bash:
	docker exec -it api-php /bin/bash
apidoc:
	apidoc -i app -o public/doc
ps:
	docker-compose ps
queue:
	docker-compose exec api-php php /app/artisan queue:work
