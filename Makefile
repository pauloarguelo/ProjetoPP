build:
	docker-compose build api-php
up:
	docker-compose stop && docker-compose up -d
stop:
	docker-compose stop
down:
	docker-compose down
bash:
	docker exec -it api-php /bin/bash