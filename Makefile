.PHONY: help

#!make
include .env

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sed 's/Makefile://' | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

# install project
install:
	cp .env.example .env
	composer install
	php artisan key:generate
	make reset

#  fresh
fresh:
	php artisan migrate:fresh --seed
	php artisan migrate:fresh --seed --env testing

# reset project
reset:
	composer install
	yarn
	make fresh

# test project
test:
	composer run pint
	composer run phpstan
	php artisan test --parallel

# test pest only
test_only:
	php artisan test --parallel

# test pest only with recreate databases
test_recreate:
	php artisan test --parallel --recreate-databases

# Style fix
style:
	composer run style:fix
