# Rent CRM API

## Commands to go:

```
$ composer install
```

```
$ mkdir var/jwt
$ openssl genrsa -out var/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
```

```
$ openssl rsa -in var/jwt/private.pem -out var/jwt/private2.pem
$ mv var/jwt/private.pem var/jwt/private.pem-back
$ mv var/jwt/private2.pem var/jwt/private.pem
```

configure db connection in .env

```
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
```

```
$ php bin/console server:run
```
or
```
$ php bin/console server:start
```

Documentation URL: /api/doc
Login URL: POST /api/login_check (keys: username, password)
