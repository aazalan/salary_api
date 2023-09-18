test:
	php artisan test --coverage

test_cover: 
	XDEBUG_MODE=coverage php artisan test --coverage

setup:
	composer install
	php artisan migrate