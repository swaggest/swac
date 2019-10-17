phar:
	@test -f $$HOME/.cache/composer/phar-composer.phar || (mkdir -p $$HOME/.cache/composer/ && wget https://github.com/clue/phar-composer/releases/download/v1.0.0/phar-composer.phar -O $$HOME/.cache/composer/phar-composer.phar)
	@composer install --no-dev;rm -rf tests/;rm -rf examples/;rm ./swac;rm ./swac.tar.gz;php -d phar.readonly=off $$HOME/.cache/composer/phar-composer.phar build;mv ./swac.phar ./swac;tar -zcvf ./swac.tar.gz ./swac;git reset --hard;composer install

docker-build:
	@docker build . -t swaggest/swac:latest
	@docker build . -t swaggest/swac:$(shell git describe --abbrev=0 --tags)

docker-push:
	@docker push swaggest/swac

lint:
	@test -f $$HOME/.cache/composer/phpstan-0.11.8.phar || (mkdir -p $$HOME/.cache/composer/ && wget https://github.com/phpstan/phpstan/releases/download/0.11.8/phpstan.phar -O $$HOME/.cache/composer/phpstan-0.11.8.phar)
	@php $$HOME/.cache/composer/phpstan-0.11.8.phar analyze -l 7 -c phpstan.neon ./src

docker-lint:
	@docker run -v $$PWD:/app --rm phpstan/phpstan analyze -l 7 -c phpstan.neon ./src

test:
	@php -derror_reporting="E_ALL & ~E_DEPRECATED" vendor/bin/phpunit

test-coverage:
	@php -derror_reporting="E_ALL & ~E_DEPRECATED" -dzend_extension=xdebug.so vendor/bin/phpunit --coverage-text

lint-examples:
	find ./examples/php-client -iname "*.php" -exec php -l {} \; | grep -i "Errors.parsing"