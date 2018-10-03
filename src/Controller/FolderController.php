<?php

namespace App\Controller;

use App\Repository\FolderRepository;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class FolderGetByPath
 */
class FolderController
{
    /**
     * @var FolderRepository
     */
    private $folderRepository;

    public function __construct(FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }

    /**
     * @ApiDoc(
     *      section="Version 1.0",
     *      description="Task list",
     *      statusCodes={
     *          200="OK",
     *      }
     * )
     *
     * @Route(
     *     name="get_by_path",
     *     path="/folders/path/{path}",
     *     methods={"GET"},
     *     requirements={"path"=".*"}
     * )
     *
     * @param $path
     *
     */
    public function getByPathAction($path)
    {
        return $this->folderRepository->findByPath($path);
    }
}
