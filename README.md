# OneId

Yagona identifikatsiya tizimi (Single identification system)

## Talablar (Requirements)

- PHP ^8.0
- Laravel ^10

## O&#8216;rnatish (Installation)

Install the package via composer:

```bash
composer require ijodkor/one-id
```

## Sozlash (Setup)

1. Muhit o&#8216;zgaruvchilari o&#8216;rnatilinadi (Set environment variables)

```dotenv
ONE_ID_SSO_URL=<one_id_sso_url>
ONE_ID_CLIENT_ID=<client_id>
ONE_ID_CLIENT_SECRET=<client_secret>
```

- Sozlama fayli yaratilinadi (Set Config file)

```php
    /*
    |--------------------------------------------------------------------------
    | OneId Integration
    |--------------------------------------------------------------------------
    | This is the OneId package
    |
    */
    'one_id_sso_url' => env('ONE_ID_SSO_URL'),
    'one_id_client_id' => env('ONE_ID_CLIENT_ID'),
    'one_id_client_secret' => env('ONE_ID_CLIENT_SECRET'),
    'one_id_client_scope' => env('ONE_ID_CLIENT_SCOPE'),
```

## Qo&#8216;shimcha sozlamalar (Extra configurations)

```dotenv
ONE_ID_CLIENT_SCOPE=test
ONE_ID_CLIENT_STATE=test
```

### Web - for monolith website and systems

- ``php artisan one-id:api-make``
- Define following route in web.php

```php
# OneId
Route::get('/one-id/access', [OneIdWebAuthController::class, 'access']);
```

### Api - for REST api website and systems

- ``php artisan one-id:web-make``
- Define following route in api.php

```php
# OneId
Route::get('/auth/token', [OneIdAuthController::class, 'token']);
```


## Ishlatish (Usage)
 - Api - those urls is ready to use
   - [POST] /api/one-id/url (name: one-id.url, )
 - Web - those urls is ready to use
   - [GET] /one-id/login (name: one-id.login)

## Foydalanilgan manbalar (References)

- [Testbench](https://packages.tools/testbench) - Laravel Testing Helper for Packages Development
- [Laravel package tools](https://packages.tools/testbench) - Tools for creating Laravel packages

## Havolalar (Links)
- https://stackoverflow.com/questions/44665234/how-copy-entire-directory-from-one-folder-to-another-using-laravel-5