# activity-recorder
![Build Status](https://travis-ci.org/benblub/activity-recorder.svg?branch=master) 

Record your work or whatever activity with this Api Project.

## Requirements
https://symfony.com/doc/current/setup.html#technical-requirements

## Install
Clone or Download & unzip this Project. 

run Composer with your Shell and install Project Depencies.
```
composer install
```
Setup Database credentials in your [ENV](https://symfony.com/doc/current/configuration.html#configuration-environments)
````
php bin/console doctrine:database:create 
php bin/console doctrine:migrations:migrate 
````

## Tests
Setup Database credentials in .env.test.  
create test Database & Structure
````
php bin/console doctrine:database:create --env=test
php bin/console doctrine:migrations:migrate --env=test
````
run tests 
````
php bin/phpunit
````

Start Transactions & Rollback between each Test. Not installed yet.. 
https://github.com/dmaicher/doctrine-test-bundle

## Use

Webserver configuration https://symfony.com/doc/current/setup/web_server_configuration.html

This Project creates your API. Now you can use any kind of App to interact with your API. 
Build your own or use a Generator from https://api-platform.com/docs/
Simply test your API visit http://localhost:8000/api
