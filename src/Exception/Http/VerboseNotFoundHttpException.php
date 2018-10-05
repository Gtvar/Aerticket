<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class VerboseNotFoundHttpException
 */
class VerboseNotFoundHttpException extends VerboseHttpException
{
    /**
     * Constructor.
     *
     * @param string     $message  The internal exception message
     * @param \Exception $previous The previous exception
     * @param integer    $code     The internal exception code
     */
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(Response::HTTP_NOT_FOUND, $message, $previous, [], $code);
    }
}
