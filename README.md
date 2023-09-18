<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2F552d6fb4-6c82-4ead-a08e-7218b93e91d9%3Fdate%3D1%26commit%3D1&style=plastic)](https://forge.laravel.com/servers/718396/sites/2104180)


## About Knot API

An API for when there's Knot an API. Knot is the missing link to interoperability between online accounts.

## Project setup

KnotAPI is an dockerized Laravel API trough Laravel Sail. After cloning the project follow steps to run a project locally:

1. Run `composer install` in project root to install all dependencies.
2. Run `./vendor/bin/sail up` to download and start KnotAPI Linux docker image.
3. Run `./vendor/bin/sail php artisan migrate` to set up a database.
4. Run `./vendor/bin/sail php artisan passport:install` to set up Oauth2 keys.
5. Run `./vendor/bin/sail php artisan db:seed` to get initial demo data.

Your APP should be up & running locally and you can access it on: `http://localhost/api`

## Starting tests

To start tests, you should run command in root app folder:
`./vendor/bin/sail php artisan test`

### Support
For any issues with KnotAPI feel free to send an email to: armingdev@gmail.com
