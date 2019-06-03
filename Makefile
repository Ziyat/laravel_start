docker-up:
	@docker-compose up -d
docker-down:
	@docker-compose down
docker-build:
	@docker-compose up --build -d
test:
	@docker-compose exec php-cli vendor/bin/phpunit
assets-install:
	@docker-compose exec node yarn install
assets-dev:
	@docker-compose exec node yarn run dev
assets-prod:
	@docker-compose exec node yarn run prod
assets-watch:
	@docker-compose exec node yarn run watch
migrate/up:
	@docker-compose exec php-cli php artisan migrate
migrate/down:
	@docker-compose exec php-cli php artisan migrate:rollback
migrate/fresh:
	@docker-compose exec php-cli php artisan migrate:fresh
perm:
	@sudo chown ${USER}:${USER} bootstrap/cache -R
	@sudo chown ${USER}:${USER} storage -R
	@if [ -d "node_modules" ]; then sudo chown ${USER}:${USER} node_modules -R; fi
	@if [ -d "public/build" ]; then sudo chown ${USER}:${USER} public/build -R; fi
