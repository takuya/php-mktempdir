# php-mktempdir
Make a Temp directory in SysTemp with temp_name and auto removed.

## mktempdir function 
This package provides a function `mktempdir()` to your composer project.
```injectablephp
<?php
require_once 'vendor/autoload.php';
$tempDir = mktempdir();
is_dir($tempDir);#=>true
```
## The TempDir will be auto remove 

`$tempDir` will be ***auto removed*** by 'register_shutdown_function'.

## system temp directory

`mktempdir()` will make tempDir in your System Temp area by 'sys_get_temp_dir'.

## Installing from GitHub.
```
composer config repositories.takuya/php-mktempdir vcs https://github.com/takuya/php-mktempdir
composer require takuya/php-rrmdir
```
## Installing with packagist.
```
composer require takuya/php-mktempdir
composer install
```

## test results.
![<CircleciTest>](https://circleci.com/gh/takuya/php-mktempdir.svg?style=svg)
## testing
```
composer install 
./vendor/bin/phpunit
```