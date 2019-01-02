# sblara

config ur db from env 
* composer update --no-scripts
* composer dump-autoload
* php artisan key:generate
* php artisan config:clear
* import db
* php artisan serve
* http://127.0.0.1:8000/test





	plugin server change requirements:
	 reset keys  => php artisan passport:keys

	401: authorization token error :
		in virtual Host:
		SetEnvIf Authorization .+ HTTP_AUTHORIZATION=$0
		
