DOCKER_COMPOSE := docker-compose

.PHONY: up down artisan composer migrate view-cache storage-link npm-build npm-dev

up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down

artisan:
	$(DOCKER_COMPOSE) run --rm artisan $(command)

composer:
	$(DOCKER_COMPOSE) run --rm composer $(command)

migrate:
	$(DOCKER_COMPOSE) run --rm artisan migrate

view-cache:
	$(DOCKER_COMPOSE) run --rm artisan view:cache

storage-link:
	$(DOCKER_COMPOSE) run --rm artisan storage:link

npm-build:
	$(DOCKER_COMPOSE) run --rm npm run build

npm-dev:
	$(DOCKER_COMPOSE) run --rm npm run dev
