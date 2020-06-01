# Logger

## Class Features
- Integration with laravel / lumen
- Automatic table creation in database
- Creating logs easily
- Send notification via discord with diferent color levels
- Automatic route creation to query logs

## Installation

```sh
composer require fng-dev/logger
```

## Configs

### Lumen

Uncomment the lines

```sh
$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
]);
```
and

```sh
$app->register(App\Providers\AuthServiceProvider::class);
```

and add

```sh
$app->register(Fng\Logger\LoggerServiceProvider::class);
```
below the last register inside the file

```sh
    bootstrap/app.php
```

## Migration

Run migrations command

```sh
    php artisan migration
```

## Route

The pre-configured route to access the logs is

```sh
    [GET] /logger/get-logs
```

## Example

### With discord webhook

```php
    use Fng\Logger\Logger;
    use Fng\Logger\Models\Log;


    $log = new Log();
    $log->level = LOG::ERROR;
    $log->description = "Hello World!!!";
    $webHook = 'discord-webhook';
    return response()->json((new Logger($webHook))->create($log));
```

### Without discord webhook

```php
    use Fng\Logger\Logger;
    use Fng\Logger\Models\Log;


    $log = new Log();
    $log->level = LOG::ERROR;
    $log->description = "Hello World!!!";
    return response()->json((new Logger())->create($log));
```

## Logging levels

Example

```php
$log->level = LOG::ERROR;
```

- ::DEBUG
- ::INFO
- ::NOTICE
- ::WARNING
- ::ERROR
- ::CRITICAL
- ::ALERT
- ::EMERGENCY

