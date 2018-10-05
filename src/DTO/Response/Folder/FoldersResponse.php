<?php

namespace App\DTO\Response\Folder;

use App\DTO\Response\Pagination\PageInterface;
use App\DTO\Response\Pagination\Paginator;
use App\DTO\Response\Pagination\Traits\PageTrait;
use App\DTO\Response\ResponseInterface;
use Swagger\Annotations as SWG;

/**
 * Class FoldersResponse
 *
 * @SWG\Definition(
 *     definition="FoldersResponse",
 *     type="object",
 *     required={"items", "metadata"},
 *     @SWG\Property(property="items", type="array", description="Items.", @SWG\Items(
 *          @SWG\Property(property="id", type="integer"),
 *          @SWG\Property(property="path", type="string")
 *     ))
 * )
 */
class FoldersResponse implements ResponseInterface, PageInterface
{
    use PageTrait;

    /**
     * Create from Paginator
     *
     * @param Paginator $paginator
     *
     * @return FoldersResponse
     */
    public static function createFromPaginator(Paginator $paginator): self
    {
        $instance = new self();

        $instance->paginate($paginator);

        return $instance;
    }
}
