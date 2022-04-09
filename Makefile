.PHONY: help

#!make
include .env

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sed 's/Makefile://' | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

# install project
install:
	cp .env.example .env
	composer install
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan key:generate
	make reset

#  fresh
fresh:
	./vendor/bin/sail artisan migrate:fresh --seed
	./vendor/bin/sail artisan migrate:fresh --seed --env testing

# reset project
reset:
	./vendor/bin/sail composer install
	./vendor/bin/sail yarn
	make fresh

# test project
test:
	./vendor/bin/sail composer run phpcs
	./vendor/bin/sail composer run phpstan
	./vendor/bin/sail artisan test --parallel

# test pest only
test_only:
	./vendor/bin/sail artisan test --parallel

# test pest only with recreate databases
test_recreate:
	./vendor/bin/sail artisan test --parallel --recreate-databases

# Style fix
style:
	./vendor/bin/sail composer run style:fix
