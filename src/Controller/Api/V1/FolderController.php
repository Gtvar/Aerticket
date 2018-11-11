<?php

namespace App\Controller\Api\V1;

use App\DTO\Request\Folder\FolderGetByPathRequest;
use App\DTO\Response\Folder\FolderGetByPathResponse;
use App\Handler\Folder\FolderGetByPathHandler;
use App\Repository\FolderRepository;
use App\Validator\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation as ApiDoc;
use Swagger\Annotations as SWG;
use App\Annotation\Controller\Rest;

/**
 * Class FolderGetByPath
 */
class FolderController
{
    /**
     * @var FolderRepository
     */
    private $folderRepository;

    /**
     * FolderController constructor.
     *
     * @param FolderRepository $folderRepository
     */
    public function __construct(FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }

    /**
     * @Route(
     *     "/api/v1//folders/path/{path}.{_format}",
     *     name="folder_get_by_path",
     *     methods={"GET"},
     *     requirements={"path"=".*"},
     *     defaults={"_format": "json", "anonymous": true}
     * )
     *
     * @Rest\View(statusCode=200)
     *
     * @SWG\Parameter(name="path", in="path", required=true, type="string", description="Path")
     *
     * @SWG\Response(
     *     response=200,
     *     @ApiDoc\Model(type=App\DTO\Response\Folder\FolderGetByPathResponse::class),
     *     description="Successful response"
     * )
     *
     * @SWG\Response(response=400, description="Validation Failed", @SWG\Schema(ref="#/definitions/error.400"))
     *
     * @SWG\Tag(name="Folder")
     *
     * @param Request                $request
     * @param Validator              $validator
     * @param FolderGetByPathHandler $folderGetByPathHandler
     *
     * @return FolderGetByPathResponse
     */
    public function getByPathAction(Request $request, Validator $validator, FolderGetByPathHandler $folderGetByPathHandler): FolderGetByPathResponse
    {
        $getByPathRequest = FolderGetByPathRequest::createFromRequest($request, $validator);

        return $folderGetByPathHandler->handle($getByPathRequest);
    }
}
