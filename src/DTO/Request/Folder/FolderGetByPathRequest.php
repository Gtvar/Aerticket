<?php

namespace App\DTO\Request\Folder;

use App\DTO\Request\RequestInterface;
use App\Exception\Subscriber\UnableResolveViewAnnotationException;
use App\Validator\Constraints;
use App\Validator\Validator;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class FolderGetByPathRequest
 *
 * @SWG\Definition(
 *     definition="FolderGetByPathRequest",
 *     type="object",
 *     required={
 *         "path"
 *      }
 * )
 */
class FolderGetByPathRequest implements RequestInterface
{
    /**
     * @var string
     *
     * @SWG\Property(property="path", type="string", description="Path.")
     *
     * @Assert\NotNull(message="folder_get_by_path_request.path.not_null")
     *
     * @Constraints\EntityReference(
     *     entityClass="App\Entity\Folder",
     *     property="path",
     *     message="folder_get_by_path_request.folder.not_found",
     * )
     */
    private $path;

    /**
     * FolderGetByPathRequest constructor.
     */
    private function __construct()
    {
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
     * Create FolderGetByPathRequest from request
     *
     * @param Request   $request
     * @param Validator $validator
     *
     * @return FolderGetByPathRequest
     */
    public static function createFromRequest(Request $request, Validator $validator): self
    {
        $instance = new self();
        $instance->path = $request->get('path');

        $validator->validate($instance);

        return $instance;
    }
}
