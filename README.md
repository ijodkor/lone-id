# OneId

Yagona identifikatsiya tizimi (Single identification system)

## Talablar (Requirements)

- PHP ^8.0
- Laravel ^10

## 1. O&#8216;rnatish (Installation)

Install the package via composer:

```bash
composer require ijodkor/one-id
```

Sozlama faylni asosiyga chiqarish

```bash
php artisan vendor:publish --provider="Ijodkor\OneId\OneIdServiceProvider"
```

## 2. Sozlash (Setup)

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

## 3. Qo&#8216;shimcha sozlamalar (Extra configurations)

```dotenv
ONE_ID_CLIENT_SCOPE=test
ONE_ID_CLIENT_STATE=test
```

### 3.1 Web - for monolith website and systems

- ``php artisan one-id:web-make``
- Define following route in web.php

```php
# OneId
Route::get('/one-id/access', [OneIdWebAuthController::class, 'access']);
```

### 3.2 Api - for REST api website and systems

- ``php artisan one-id:api-make``
- Define following route in api.php

```php
# OneId
Route::post('/auth/token', [OneIdAuthController::class, 'token']);
```

## 4. Ishlatish (Usage)

Modulni ham API ham odatiy WEB uslubda ishlatish mumkin

- Api
    1. [POST/GET] [/api/one-id/url](/api/one-id/url) (name: one-id.url) - OneIdga o&#8216;tish uchun havola beradi
    2. [POST] [/api/auth/token](/api/auth/token) - OneId bergan kod (code) bilan token olish. (Ushbu manzil ixtiyoriy
       tartibda o&#8216;zgartirilishi mumkin, 3.2 dagi manzil bilan bir xil qo&#8216;yiladi)
- Web
    1. [GET] [/one-id/login](/one-id/login) (name: one-id.login) - OneId SSO sahifasiga o*#8216;tadi
    2. [GET] [/one-id/access](/one-id/access) - OneId orqali kod (code) bilan kirib kelganda tizimga kiritish. (Ushbu
       manzil ixtiyoriy tartibda o&#8216;zgartirilishi mumkin, 3.1 dagi manzil bilan bir xil qo&#8216;yiladi)

## Foydalanilgan manbalar (References)

- [Testbench](https://packages.tools/testbench) - Laravel Testing Helper for Packages Development
- [Laravel package tools](https://packages.tools/testbench) - Tools for creating Laravel packages

## Havolalar (Links)

- https://stackoverflow.com/questions/44665234/how-copy-entire-directory-from-one-folder-to-another-using-laravel-5
- https://dev.to/stndc/colors-in-php-command-line-output-4ela