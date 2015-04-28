[![Build Status](https://travis-ci.org/mindofmicah/laravel-datatables.svg)](https://travis-ci.org/mindofmicah/laravel-datatables)
[![Latest Stable Version](https://poser.pugx.org/mindofmicah/laravel-datatables/v/stable.svg)](https://packagist.org/packages/mindofmicah/laravel-datatables)
[![Latest Unstable Version](https://poser.pugx.org/mindofmicah/laravel-datatables/v/unstable.svg)](https://packagist.org/packages/mindofmicah/laravel-datatables)
[![License](https://poser.pugx.org/mindofmicah/laravel-datatables/license.svg)](https://packagist.org/packages/mindofmicah/laravel-datatables)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/2be0811e-861b-453d-9c27-8ba17a77e893/mini.png)](https://insight.sensiolabs.com/projects/2be0811e-861b-453d-9c27-8ba17a77e893)
# laravel datatables


## Usage

### Step 1: Install Through Composer

```
composer require mindofmicah/laravel-datatables
```

### Step 2: Add the Service Provider
```php
'MindOfMicah\LaravelDatatables\DatatableProvider'
```
### Step 3: Add the Facade(optional)
```php
'Datatable' => 'MindOfMicah\LaravelDatatables\DatatableFacade'
```
## Running the tests
Make sure that the storage directory has 777 permissions when running tests
