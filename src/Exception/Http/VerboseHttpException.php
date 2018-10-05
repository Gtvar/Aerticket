<?php

namespace App\Exception\Http;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class VerboseHttpException
 */
class VerboseHttpException extends HttpException
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        $statusCode,
        $message = null,
        \Exception $previous = null,
        array $headers = [],
        $code = 0
    )
    {
        $headers['X-Exception-Verbose'] = 1;

        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }
}
