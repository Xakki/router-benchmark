SHELL = /bin/bash

dock:= docker compose exec php

up:
	docker compose up --force-recreate -d
	$(dock) sh -c "composer install --prefer-dist"
	$(dock) sh -c "rr serve -p"

up-build:
	docker compose up --build

# Консоль в docker
sh:
	$(dock) sh

composer-r:
	$(dock) sh -c "composer require --prefer-dist phpbench/phpbench"

# Обновление всех пакетов в композере --ignore-platform-reqs
composer-u:
	$(dock) sh -c "composer update --prefer-dist"


run:
	$(dock) sh -c "./vendor/bin/phpbench run tests --report=default"

run2:
	$(dock) sh -c "./vendor/bin/phpbench run tests --report=aggregate --retry-threshold=5 --iterations=10"

gen:
	$(dock) sh -c "php ./src/generator.php"

#https://roadrunner.dev/docs/app-server-cli/current/en
rr-run:
	$(dock) sh -c "rr serve -p"

rr-stop:
	$(dock) sh -c "rr stop"

