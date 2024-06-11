deploy:
	ssh o2switch 'cd/tape-in.fr && git pull origin main && make install'


install:


.env:
	cp .env.example .env
	php artisan key:generate


.vendor/autoload.php: composer.lock
	composer install
	touch vendor/autoload.php


public/build/manifest.json package.json	




