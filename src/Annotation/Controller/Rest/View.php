<?php

namespace App\Annotation\Controller\Rest;

/**
 * View annotation class.
 *
 * @Annotation
 *
 * @Target({"METHOD","CLASS"})
 */
class View
{
    private const GROUP_READ = 'read';

    /**
     * @var int
     */
    public $statusCode;

    /**
     * @var array
     */
    protected $serializerGroups = self::GROUP_READ;

    /**
     * @param integer $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param array $serializerGroups
     */
    public function setSerializerGroups($serializerGroups)
    {
        $this->serializerGroups = $serializerGroups;
    }

    /**
     * @return array
     */
    public function getSerializerGroups()
    {
        return $this->serializerGroups;
    }
}
