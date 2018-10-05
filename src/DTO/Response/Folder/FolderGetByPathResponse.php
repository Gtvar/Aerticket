<?php

namespace App\DTO\Response\Folder;

use App\DTO\Response\ResponseInterface;
use App\Entity\Folder;
use Swagger\Annotations as SWG;

/**
 * Class FolderGetByPathResponse
 *
 * @SWG\Definition(
 *     definition="FolderGetByPathResponse",
 *     type="object",
 *     required={
 *         "id",
 *         "path"
 *     }
 * )
 */
class FolderGetByPathResponse implements ResponseInterface
{
    /**
     * @var string
     *
     * @SWG\Property(type="integer", description="Folder id.")
     */
    private $id;

    /**
     * @var string
     *
     * @SWG\Property(type="string", description="Path.")
     */
    private $path;

    /**
     * FolderGetByPathResponse constructor.
     */
    private function __construct()
    {
    }

    /**
     * Get Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Create from Folder
     *
     * @param Folder $folder
     *
     * @return FolderGetByPathResponse
     */
    public static function createFromFolder(Folder $folder): self
    {
        $instance = new self();

        $instance->id = $folder->getId();
        $instance->path = $folder->getPath();

        return $instance;
    }
}
