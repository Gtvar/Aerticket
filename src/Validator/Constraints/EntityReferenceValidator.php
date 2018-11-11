<?php

namespace App\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class EntityReferenceValidator
 */
class EntityReferenceValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * EntityReferenceValidator constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Valid entity object is found
     *
     * @param string     $value
     * @param Constraint $constraint
     *
     * @throws UnexpectedTypeException
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof EntityReference) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\EntityReference');
        }

        if (is_null($value)) {
            return;
        }

        $found = $this->entityManager->getRepository($constraint->entityClass)->findOneBy([
            $constraint->property => $value,
        ]);

        if (!$found) {
            $this->context->addViolation($constraint->message);
        }
    }
}
