# Repository-Comparator
The project is a tool to compare two different repositories. The purpose of it is to help developer to choose better open source software. 
The tool allows to get basic statistics of a repository such as: forks count, last release date, closed pull requests count and others.
 As a result, developer can see comparison of two repositories and the winner of every statistic category.
 
## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
Before you start, you need to have PHP of version at least 7.1.3 installed. You also need to install composer following the instruction:
```
sudo curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```
### Installing
A step by step example that tell you how to get a development env running
1. You need to copy .env.example file to your .env file and provide your Github Api Key.
2. Run the following command: 
```
composer install
``` 

## Running the application
To run the application you need to use the following command
```
php -S localhost:8000 -t public
```

## Running the tests
To run the application tests you need to use the following command
```
vendor/bin/phpunit
```

## Documentation
Documentation is provided by swagger. To generate documentation file, run the command
```
php artisan swagger-lume:generate
```
You can access the documentation on the following url:
```
http://localhost:8000/docs
```