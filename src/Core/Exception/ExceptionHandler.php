<?php

declare(strict_types=1);

namespace App\Core\Exception;

use App\Core\MVC\View;
use ErrorException;
use Throwable;

class ExceptionHandler
{
    public function register(): void
    {
        set_exception_handler([$this, 'handleException']);
    }

    public function handleException(Throwable $e): void
    {
        if ($e->getCode() === 404) {
            echo View::render('errors/404.tpl');
        }

        $this->log($e);
    }

    private function log(Throwable $e): void
    {
        $line = sprintf(
            "[%s] %s: %s in %s:%d\n%s\n",
            date('c'),
            $e::class,
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        );
        error_log($line, 3,  '/var/www/var/log/error.log');
    }
}