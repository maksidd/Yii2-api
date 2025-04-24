up:
	docker compose up --build -d

down:
	docker compose down

logs:
	docker compose logs -f

restart:
	make down
	make up
