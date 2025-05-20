include .env

install: docker-build up composer init migrate
up: docker-up
down: docker-down
restart: docker-down docker-up
clear: docker-down-clear

init:
	@docker compose exec php-fpm-admin sh -c "php init --env=Development --overwrite=y"

composer:
	@docker compose exec php-fpm-admin sh -c "composer install"

migrate:
	@docker compose exec php-fpm-admin sh -c "php yii migrate"


docker-build:
	@echo "build images"

	@docker build \
    			-t detailing-front-php-fpm:latest \
    			--build-arg="USER=www-data" \
    			--build-arg="GROUP=www-data" \
    			--target php-fpm-front . \

	@docker build \
        			-t detailing-lk-php-fpm:latest \
        			--build-arg="USER=www-data" \
        			--build-arg="GROUP=www-data" \
        			--target php-fpm-lk . \

	@docker build \
        			-t detailing-admin-php-fpm:latest \
        			--build-arg="USER=www-data" \
        			--build-arg="GROUP=www-data" \
        			--target php-fpm-admin . \

	@docker build -t slava-nginx:latest --target nginx .

docker-up:
	@echo "docker up"
	@docker compose up -d

docker-down:
	@echo "docker down"
	@docker compose down --remove-orphans

docker-down-clear:
	@echo "docker down clear"
	@docker compose down -v --remove-orphans
#
#post-install:
#	@echo "post install"
#	if [ ${DOCKER_ENV} = "local" ]; then \
#		$(MAKE) composer-install; \
#		$(MAKE) generate-pem-keys; \
#		$(MAKE) compile-assets; \
#	fi
#	$(MAKE) migrate
#	$(MAKE) flush-cache
#
#docker-down:
#	@echo "docker down"
#	$(MAKE) CMD="down --remove-orphans" docker-compose-cmd
#
#docker-down-clear:
#	@echo "docker clear"
#	$(MAKE) CMD="down -v --remove-orphans" docker-compose-cmd
#
#shell:
#	$(MAKE) CMD="exec php-fpm /bin/bash" docker-compose-cmd
#
#cold-shell:
#	$(MAKE) CMD="run --rm php-fpm /bin/bash" docker-compose-cmd
#
#nginx-reload:
#	$(MAKE) CMD="exec nginx nginx -s reload" docker-compose-cmd
#
#migrate:
#	$(MAKE) CMD="exec php-fpm bin/console doctrine:migrations:migrate --no-interaction" docker-compose-cmd
#
#composer-install:
#	$(MAKE) CMD="run --rm php-fpm composer install" docker-compose-cmd
#
#flush-cache:
#	$(MAKE) CMD="exec php-fpm bin/console cache:clear" docker-compose-cmd
#
#compile-assets:
#	$(MAKE) CMD="exec php-fpm bin/console asset-map:compile" docker-compose-cmd
#
#generate-pem-keys:
#	$(MAKE) CMD="run --rm php-fpm mkdir -p config/oauth/ && openssl genrsa -aes128 -passout pass:${OAUTH_PASSPHRASE} -out config/oauth/private.key 2048 && openssl rsa -in config/oauth/private.key -passin pass:${OAUTH_PASSPHRASE} -pubout -out config/oauth/public.key && chmod -R 755 config/oauth/" docker-compose-cmd
#
#docker-compose-cmd:
#	if [ ${DOCKER_ENV} = "local" ]; then \
#		docker compose -f docker-compose-local.yml $(CMD); \
#	else \
#		docker compose -f docker-compose.yml $(CMD); \
#	fi
