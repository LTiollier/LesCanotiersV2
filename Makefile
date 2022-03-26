#!make
include .env
export $(shell sed 's/=.*//' .env)

#  fresh
fresh:
	./vendor/bin/sail artisan migrate:fresh --seed

# reset project
reset:
	./vendor/bin/sail composer install
	./vendor/bin/sail yarn
	make fresh

# test project
test:
    ./vendor/bin/sail artisan test --parallel

# Help instructions
help:
	@echo "\033[0;33mUsage:\033[0m"
	@echo "     make [target]\n"
	@echo "\033[0;33mAvailable targets:\033[0m"
	@awk '/^[a-zA-Z\-\_0-9\.@]+:/ { \
		returnMessage = match(n4line, /^# (.*)/); \
		if (returnMessage) { \
			printf "\n"; \
			printf "     %s\n", n5line; \
			printf "     %s\n", n4line; \
			printf "     %s\n", n3line; \
			printf "\n"; \
		} \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")); \
			helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf "     \033[0;32m%-22s\033[0m %s\n", helpCommand, helpMessage; \
		} \
	} \
	{ n5line = n4line; n4line = n3line; n3line = n2line; n2line = lastLine; lastLine = $$0;}' $(MAKEFILE_LIST)
	@echo ""
