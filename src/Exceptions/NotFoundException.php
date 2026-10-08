<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Core\Exception\HttpException;

class NotFoundException extends HttpException
{
    public function __construct()
    {
        parent::__construct('Not found.', 404);
    }
}