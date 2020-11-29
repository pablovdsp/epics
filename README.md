<h1 align="center">
  Vagas EPICS - Teste Back-end
</h1>

## Requirements
* PHP 7.2
* Composer
* Postman
* MySQL

## Clone this Repository
```sh
git clone https://github.com/pablovdsp/epics.git
```
## Install the dependencies
```sh
composer install
```
## Configure the .env file with database credentials
## Run Migrations
```sh
php artisan migrate
```
## Import the .json file to your Postman

## Unit Tests
Run the Migration with seeds
```sh
php artisan migrate:fresh --seed
```
And run the unit test
```sh
vendor/bin/phpunit --filter=UserTest
```
