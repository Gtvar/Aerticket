<?php

namespace App\Exception\Validator;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class InvalidParamsException
 */
class InvalidParamsException extends \Exception
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $list;

    /**
     * InvalidParamsException constructor.
     *
     * @param ConstraintViolationListInterface $list
     */
    public function __construct(ConstraintViolationListInterface $list)
    {
        $this->list = $list;

        parent::__construct('Params not valid');
    }

    /**
     * Get list
     *
     * @return ConstraintViolationListInterface
     */
    public function getList(): ConstraintViolationListInterface
    {
        return $this->list;
    }
}
