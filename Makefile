test:
	php artisan test --testsuite=Feature

test_cover: 
	XDEBUG_MODE=coverage php artisan test --coverage

setup:
	composer install
	cp -n .env.example .env
	touch database/database.sqlite
	php artisan migrate