<?php

use Monolog\Logger;
use Illuminate\Log\Writer;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Move the various types of error messages to different log files
|--------------------------------------------------------------------------
|
*/
$app->configureMonologUsing(function($monolog) {

  $logFormat = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
  $logFormatInfo = "[%datetime%] %channel%.%level_name%: %message% \nLog Entry Details:\n%context%\n%extra%\n";
  $formatter = new LineFormatter($logFormat, null, true);
  $formatterInfo = new LineFormatter($logFormatInfo, null, true);

  $bubble = false;

  $debugStreamHandler = new StreamHandler(storage_path("/logs/debug.log"), Logger::DEBUG, $bubble);
  $infoStreamHandler = new StreamHandler(storage_path("/logs/info.log"), Logger::INFO, $bubble);
  $noticeStreamHandler = new StreamHandler(storage_path("/logs/notice.log"), Logger::NOTICE, $bubble);
  $warningStreamHandler = new StreamHandler(storage_path("/logs/warning.log"), Logger::WARNING, $bubble);
  $errorStreamHandler = new StreamHandler(storage_path("/logs/error.log"), Logger::ERROR, $bubble);
  $criticalStreamHandler = new StreamHandler(storage_path("/logs/critical.log"), Logger::CRITICAL, $bubble);
  $alertStreamHandler = new StreamHandler(storage_path("/logs/alert.log"), Logger::ALERT, $bubble);
  $emergencyStreamHandler = new StreamHandler(storage_path("/logs/emergency.log"), Logger::EMERGENCY, $bubble);

  $monolog->pushHandler($debugStreamHandler);
  $monolog->pushHandler($infoStreamHandler);
  $monolog->pushHandler($noticeStreamHandler);
  $monolog->pushHandler($warningStreamHandler);
  $monolog->pushHandler($errorStreamHandler);
  $monolog->pushHandler($criticalStreamHandler);
  $monolog->pushHandler($alertStreamHandler);
  $monolog->pushHandler($emergencyStreamHandler);

  $debugStreamHandler->setFormatter($formatter);
  $infoStreamHandler->setFormatter($formatterInfo);
  $noticeStreamHandler->setFormatter($formatter);
  $warningStreamHandler->setFormatter($formatter);
  $errorStreamHandler->setFormatter($formatter);
  $criticalStreamHandler->setFormatter($formatter);
  $alertStreamHandler->setFormatter($formatter);
  $emergencyStreamHandler->setFormatter($formatter);

});


/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
