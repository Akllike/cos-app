DOCKER_COMPOSE := docker-compose

.PHONY: build up down exec shell artisan composer test

up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down

artisan:
	$(DOCKER_COMPOSE) run artisan $(command)

composer:
	$(DOCKER_COMPOSE) run composer $(command)

migrate:
	$(DOCKER_COMPOSE) run artisan migrate

view-cache:
	$(DOCKER_COMPOSE) run artisan view:cache

storage-link:
	$(DOCKER_COMPOSE) run artisan storage:link

npm-build:
	$(DOCKER_COMPOSE) run npm run build

npm-dev:
	$(DOCKER_COMPOSE) run npm run dev
