Search Flight
=============

Requirements
------------

* PHP 7.1+ (extensions: curl, intl, json, mbstring, mysql, opcache, pdo, sqlite)

Initialize
----------

```sh
composer install
```

#### Necessarily Run tests
DB data will be load from fixtures
```sh
phpunit tests
```

#### Run server

```sh
bin/console server:run
```

Checks
----------

#### Open API Doc

http://127.0.0.1:8000/api/doc

#### Open Client page

http://127.0.0.1:8000/client/
```sh
user: api
password: apipass
```
