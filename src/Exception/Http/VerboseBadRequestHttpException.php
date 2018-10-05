<?php

namespace App\Exception\Http;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class VerboseBadRequestHttpException
 */
class VerboseBadRequestHttpException extends VerboseHttpException
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
        parent::__construct(Response::HTTP_BAD_REQUEST, $message, $previous, [], $code);
    }
}
