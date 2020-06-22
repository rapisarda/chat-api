FIG=docker-compose
CONSOLE=bin/console
PHP=$(FIG) exec php

start: build up # Install and start the project

stop:           ## Remove docker containers
	$(FIG) kill
	$(FIG) rm -v --force

reset: stop start # Reset the whole project

build:
	$(FIG) build

up:
	$(FIG) up -d --remove-orphans

install: start
	$(PHP) composer install
	$(PHP) $(CONSOLE) doctrine:database:create

database:
	$(PHP) $(CONSOLE) doctrine:database:create

dropdb:
	$(PHP) $(CONSOLE) doctrine:database:drop --force

cc:
	$(PHP) $(CONSOLE) cache:clear

migration:
	$(PHP) $(CONSOLE) make:migration

migrate:
	$(PHP) $(CONSOLE) doctrine:migration:migrate -n

schema:
	$(PHP) $(CONSOLE) doctrine:schema:update --force

reset-db: dropdb database schema

fixtures:
	$(PHP) $(CONSOLE) doctrine:fixtures:load -n
