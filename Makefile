DOCKER_COMPOSE := docker-compose
ARTISAN := artisan

.PHONY: up down artisan composer migrate view-cache storage-link storage-ulink config-cache npm-build npm-dev

.SILENT:

up:
	echo "Start docker containers..."
	$(DOCKER_COMPOSE) up -d

down:
	echo "Stop docker containers..."
	$(DOCKER_COMPOSE) down

artisan:
	$(DOCKER_COMPOSE) run --rm $(ARTISAN) $(command)

composer:
	$(DOCKER_COMPOSE) run --rm composer $(command)

migrate:
	echo "Start artisan migrate..."
	$(DOCKER_COMPOSE) run --rm $(ARTISAN) migrate

view-cache:
	echo "Start artisan view cache..."
	$(DOCKER_COMPOSE) run --rm $(ARTISAN) view:cache

storage-link:
	echo "Start artisan storage link..."
	$(DOCKER_COMPOSE) run --rm $(ARTISAN) storage:link

storage-unlink:
	echo "Start artisan storage unlink..."
	$(DOCKER_COMPOSE) run --rm $(ARTISAN) storage:unlink

config-cache:
	echo "Start artisan config cache..."
	$(DOCKER_COMPOSE) run --rm $(ARTISAN) config:cache

npm-build:
	echo "Start npm build..."
	$(DOCKER_COMPOSE) run --rm npm run build

npm-dev:
	echo "Start npm dev..."
	$(DOCKER_COMPOSE) run --rm npm run dev
