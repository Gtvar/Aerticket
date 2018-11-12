<?php

namespace App\Handler\Folder;

use App\DTO\Request\Folder\FolderGetByPathRequest;
use App\DTO\Response\Folder\FolderGetByPathResponse;
use App\Entity\Folder;
use App\Exception\Http\VerboseNotFoundHttpException;
use App\Repository\FolderRepository;

/**
 * Class FolderGetByPathHandler
 */
class FolderGetByPathHandler
{
    /**
     * @var FolderRepository
     */
    private $folderRepository;

    /**
     * FolderGetByPathHandler constructor.
     *
     * @param FolderRepository $folderRepository
     */
    public function __construct(FolderRepository $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }

    /**
     * Handle
     *
     * @param FolderGetByPathRequest $folderGetByPathRequest
     *
     * @return FolderGetByPathResponse
     */
    public function handle(FolderGetByPathRequest $folderGetByPathRequest): FolderGetByPathResponse
    {
        $folder = $this->folderRepository->findByPath($folderGetByPathRequest->getPath());

        if (!$folder instanceof Folder) {
            throw new VerboseNotFoundHttpException('folder.not_found');
        }

        return FolderGetByPathResponse::createFromFolder($folder);
    }
}
