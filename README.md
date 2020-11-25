# activity-recorder
Record your work or whatever activity with this Api Project.

## Requirements
https://symfony.com/doc/current/setup.html#technical-requirements

## Install
Clone or Download & unzip this Project. 

run Composer with your Shell and install Project Depencies.
```
composer install
```

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