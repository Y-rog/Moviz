.PHONY: install deploy

deploy:
	ssh y-rog 'cd sites/moviz.y-rog.com && git pull origin main && make install'

install: vendor/autoload.php
	php bin/console doctrine:database:create -n
	php bin/console importmap:install
	php bin/console asset-map:compile
	composer dump-env prod
	php bin/console cache:clear

vendor/autoload.php: composer.lock composer.json
	composer install --no-dev --optimize-autoloader
	touch vendor/autoload.php
	