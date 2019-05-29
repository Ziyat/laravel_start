docker-up:
	@docker-compose up -d
docker-down:
	@docker-compose down
docker-build:
	@docker-compose up --build -d
test:
	@docker exec explores_php-cli_1 vendor/bin/phpunit --colors=always
assets-install:
	@docker exec explores_node_1 yarn install
assets-dev:
	@docker exec explores_node_1 yarn run dev
assets-watch:
	@docker exec explores_node_1 yarn run watch
perm:
	@sudo chown ${USER}:${USER} bootstrap/cache -R
	@sudo chown ${USER}:${USER} storage -R
	@if [ -d "node_modules" ]; then sudo chown ${USER}:${USER} node_modules -R; fi
	@if [ -d "public/build" ]; then sudo chown ${USER}:${USER} public/build -R; fi
