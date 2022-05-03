SHELL := /bin/bash
.DEFAULT_GOAL = help

COMPOSE = docker compose -f docker-compose.yml -f docker-compose-dev.yml
DOCKER_EXEC = docker compose exec
DOCKER_EXEC_PHP = ${DOCKER_EXEC} ${CTNR_PHP}
DOCKER_EXEC_PHP_BC = ${DOCKER_EXEC_PHP} ${PHP_BC}
DOCKER_EXEC_NODE = ${DOCKER_EXEC} ${CTNR_NODE}

CTNR_PHP = php-modulo-service
CTNR_NODE = node-modulo-service

PHP_BC = php bin/console

.PHONY: help
# Show this help message
help:
	@cat $(MAKEFILE_LIST) | docker run --rm -i xanders/make-help

.PHONY: start
# start project
start: up perm bundles db cc perm

##
## Docker
##

.PHONY: up
# Build docker image
up: kill
	${COMPOSE} up -d --build

.PHONY: kill
# kill all containers
kill:
	docker kill $$(docker ps -q) || true

.PHONY: bash
# Run shell inside php-container
bash:
	${DOCKER_EXEC_PHP} ${SHELL}

.PHONY: node-bash
# Run shell inside php-container
node-bash:
	${DOCKER_EXEC_NODE} ${SHELL}

.PHONY: clean
# Clean all, warning all volumes and networks will be delete
clean:
	docker stop $$(docker ps -a -q)
	docker rm $$(docker ps -a -q)
	docker volume prune
	docker network prune

##
## Composer
##

COMPOSER = ${DOCKER_EXEC_PHP} composer

.PHONY: cpr
# Composer in php-container with your command, c='{value}''
cpr:
	${COMPOSER} $(c)

.PHONY: cpr-i
# Install php dependencies
cpr-i:
	${COMPOSER} install

.PHONY: cpr-u
# Update php dependencies
cpr-u:
	${COMPOSER} update

##
## NPM
##

NPM = ${DOCKER_EXEC_NODE} npm
YARN = ${DOCKER_EXEC_NODE} yarn

.PHONY: npm
# Npm in node-container with your command, c='{value}''
npm:
	${NPM} $(c)

.PHONY: yarn
# Yarn in node-container with your command, c='{value}''
yarn:
	${YARN} $(c)

.PHONY: yarn-i
# Install node modules with yarn
yarn-i:
	${YARN} install

.PHONY: yarn-u
# Upgrade node modules with your command, c='{value}''
yarn-u:
	${YARN} upgrade $(c)

.PHONY: yarn-uall
# Upgrade all node modules with yarn
yarn-uall:
	${YARN} yarn-upgrade-all

.PHONY: ys
# Yarn in node-container start project
ys:
	${YARN} start

.PHONY: yb
# Yarn in node-container build project
yb:
	${YARN} build

##
## Database
##

DOCTRINE = ${DOCKER_EXEC_PHP_BC} doctrine:
DOCTRINE_DB = ${DOCTRINE}d:
DOCTRINE_SCHEMA = ${DOCTRINE}s:
DOCTRINE_FIXTURES = ${DOCTRINE}f:
DOCTRINE_CACHE = ${DOCTRINE}cache:
DOCTRINE_CACHE_CLEAR = ${DOCTRINE_CACHE}clear-

.PHONY: build
# Drop, create db, update schema and load fixtures
db: db-cache db-d db-c db-su db-fl

.PHONY: db-d
# Drop database
db-d:
	${DOCTRINE_DB}d --if-exists -f
	${DOCTRINE_DB}d -f --env=test

.PHONY: db-c
# Create database
db-c:
	${DOCTRINE_DB}c --if-not-exists
	${DOCTRINE_DB}c --env=test

.PHONY: db-su
# Update database schema
db-su:
	${DOCTRINE_SCHEMA}u -f
	${DOCTRINE_SCHEMA}u -f --env=test

.PHONY: db-v
# Check database schema
db-v:
	${DOCTRINE_SCHEMA}v
	${DOCTRINE_SCHEMA}v --env=test

.PHONY: db-fl
# Load fixtures
db-fl:
	${DOCTRINE_FIXTURES}l -n
	${DOCTRINE_FIXTURES}l -n --env=test

.PHONY: db-m
# Make migrations
db-m:
	${DOCTRINE}m:m

.PHONY: db-cache
# Clear doctrine cache
db-cache: db-cache-r db-cache-q db-cache-m

.PHONY: db-cache-r
# Clear result
db-cache-r:
	${DOCTRINE_CACHE_CLEAR}result

.PHONY: db-cache-q
# Clear query
db-cache-q:
	${DOCTRINE_CACHE_CLEAR}query

.PHONY: db-cache-m
# Clear metadata
db-cache-m:
	${DOCTRINE_CACHE_CLEAR}metadata

##
## Test
##

VENDOR = vendor/bin/
TEST = ${DOCKER_EXEC_PHP} ${VENDOR}

.PHONY: test
# Run behat test
test: behat phpcs phpunit

.PHONY: behat
# Run behat test
behat:
	${TEST}behat

.PHONY: phpcs
# Run phpcs test
phpcs:
	${TEST}phpcs -s

.PHONY: phpunit
# Run phpunit test
phpunit:
	${TEST}phpunit

##
## Git flow
##

GIT = git
FLOW = ${GIT} flow

.PHONY: feature
# Create new feature branch
feature:
	${FLOW} feature start $(c)

##
## Git
##

.PHONY: filemode
# Ignore filemode changes
filemode:
	${GIT} config core.filemode false
	make diff

.PHONY: diff
# Show diff
diff:
	${GIT} diff

.PHONY: aliases
# Show aliases
aliases:
	${GIT} config --list | grep alias

##
## Symfony
##

.PHONY: perm
# Fix permissions of all files
perm:
	sudo chown -R www-data:$(USER) .
	sudo chmod -R g+rwx .

.PHONY: cc
# Clear the cache
cc:
	${DOCKER_EXEC_PHP_BC} c:c --no-warmup
	${DOCKER_EXEC_PHP_BC} c:warmup

.PHONY: purge
# Purge cache and logs
purge:
	sudo rm -rf var/cache/* var/logs/*

.PHONY: commands
# Display all commands in the project namespace
commands:
	${DOCKER_EXEC_PHP_BC} list modulo

.PHONY: bundles
# Display all commands in the project namespace
bundles: cpr-i yarn-i

##
## Yarn
##

.PHONY: yarn-lint
# Run yarn lint
yarn-lint:
	${YARN} lint

.PHONY: yarn-lint-fix
# Run yarn lint
yarn-lint-fix:
	${YARN} lint-and-fix

##
## Processes
##

.PHONY: up-pp
# Update preprod without docker
up-pp:
	cd api && composer install -q
	cd client && yarn install --non-interactive
	cd api \
		&& php bin/console doctrine:cache:clear-result \
		&& php bin/console doctrine:cache:clear-query \
		&& php bin/console doctrine:cache:clear-metadata \
	    && php bin/console doctrine:migrations:migrate -n \
		&& php bin/console cache:clear --no-warmup \
		&& php bin/console cache:warmup

.PHONY: up-pp-d
# Update preprod with docker
up-pp-d: bundles db cc


