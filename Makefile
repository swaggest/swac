PHPSTAN_VERSION ?= 0.12.60

docker-phar:
	@test -f $$HOME/.cache/composer/phar-composer.phar || (mkdir -p $$HOME/.cache/composer/ && curl https://github.com/clue/phar-composer/releases/download/v1.2.0/phar-composer-1.2.0.phar -sLo $$HOME/.cache/composer/phar-composer.phar)
	@composer install --no-dev --prefer-dist;rm -rf tests/;rm -rf examples/;rm ./swac;rm ./swac.tar.gz;docker run -v $(shell pwd):/code -v $$HOME/.cache/composer/phar-composer.phar:/phar-composer.phar -w /code --rm composer:1.10.0 php -d phar.readonly=off /phar-composer.phar build;mv ./swac.phar ./swac;chmod +x ./swac;tar -zcvf ./swac.tar.gz ./swac;git reset --hard;composer install

phar:
	@test -f $$HOME/.cache/composer/phar-composer.phar || (mkdir -p $$HOME/.cache/composer/ && curl https://github.com/clue/phar-composer/releases/download/v1.2.0/phar-composer-1.2.0.phar -sLo $$HOME/.cache/composer/phar-composer.phar)
	@composer install --no-dev --prefer-dist;rm -rf tests/;rm -rf examples/;rm ./swac;rm ./swac.tar.gz;php -d phar.readonly=off $$HOME/.cache/composer/phar-composer.phar build;mv ./swac.phar ./swac;tar -zcvf ./swac.tar.gz ./swac;git reset --hard;composer install

docker-build-push:
	@docker buildx build --push --platform linux/amd64,linux/arm64/v8 . -t swaggest/swac:latest
	@docker buildx build --push --platform linux/amd64,linux/arm64/v8 . -t swaggest/swac:$(shell git describe --abbrev=0 --tags)

lint:
	@test -f ${HOME}/.cache/composer/phpstan-${PHPSTAN_VERSION}.phar || (mkdir -p ${HOME}/.cache/composer/ && wget https://github.com/phpstan/phpstan/releases/download/${PHPSTAN_VERSION}/phpstan.phar -O ${HOME}/.cache/composer/phpstan-${PHPSTAN_VERSION}.phar)
	@php $$HOME/.cache/composer/phpstan-${PHPSTAN_VERSION}.phar analyze -l 7 -c phpstan.neon ./src

docker-lint:
	@docker run -v $$PWD:/app --rm phpstan/phpstan analyze -l 7 -c phpstan.neon ./src

test:
	@php -derror_reporting="E_ALL & ~E_DEPRECATED" vendor/bin/phpunit

test-go:
	@cd ./examples/go-client && go test ./...

test-coverage:
	@php -derror_reporting="E_ALL & ~E_DEPRECATED" -dzend_extension=xdebug.so -dxdebug.mode=coverage vendor/bin/phpunit --coverage-text

lint-examples:
	@find ./examples/php-guzzle-client -iname "*.php" -exec php -l {} \; | grep -v "No syntax errors"
	@cd ./examples/go-client && golangci-lint run --enable-all ./...