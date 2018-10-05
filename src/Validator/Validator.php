<?php

namespace App\Validator;

use App\Exception\Validator\InvalidParamsException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class Validator
 */
class Validator
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * Validator constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validate data
     *
     * @param mixed                                   $value
     * @param null|Collection|Constraint[]|Constraint $constraints
     * @param null|string[]                           $groups
     *
     * @throws InvalidParamsException
     */
    public function validate($value, $constraints = null, ?array $groups = null): void
    {
        $errors = $this->validator->validate($value, $constraints, $groups);
        if (0 !== \count($errors)) {
            throw new InvalidParamsException($errors);
        }
    }
}
