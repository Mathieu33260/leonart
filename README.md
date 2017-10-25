# leonart
Projet Web dawin (sujet culture)



# Laravel Boilerplate
#### Installation
```shell
# Clone the project
git clone https://github.com/Mathieu33260/leonart.git
cd laravel-boilerplate
 
# Copy the .env.example file
cp .env.example .env
 
# Install PHP dependencies
composer install
 
# Generates app keys
php artisan key:generate
 
# Install NPM dependencies
npm install
 
# Run the server
php artisan serve
```
#### Assets
```shell
# Development build
npm run dev
 
# Watch/Hot reload
npm run watch / hot
 
# Production build
npm run production
```

#### Production
Theses commands are required to properly set laravel in production mode
```shell
# Set app in production (update .env)
APP_ENV=production
APP_DEBUG=false
APP_LOG_LEVEL=error

 
# Caches the service providers & composer autoloads
php artisan optimize
 
# Caches routes: only if not using route closure
php artisan route:cache
 
# Caches configurations: only if using config() in the app not env()
php artisan config:cache
```

Updating the **phpunit.xml** may be needed (DB_CONNECTION, DB_DATABASE)
#### Built with:

- [PHP](http://php.net)
- [Laravel 5.4](https://laravel.com)
- [MySQL](https://mysql.com)
- [Laravel Mix](https://)
