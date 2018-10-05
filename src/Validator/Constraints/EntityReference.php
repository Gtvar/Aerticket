<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class EntityReference
 *
 * @Annotation
 */
class EntityReference extends Constraint
{
    /**
     * @var string
     */
    public $entityClass;

    /**
     * @var string
     */
    public $property = 'id';

    /**
     * @var string
     */
    public $message = 'entity.not_found';

    /**
     * Get required options
     *
     * @return string[]
     */
    public function getRequiredOptions(): array
    {
        return ['entityClass'];
    }
}
