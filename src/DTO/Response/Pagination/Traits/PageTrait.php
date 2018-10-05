<?php

namespace App\DTO\Response\Pagination\Traits;

use App\DTO\Response\Pagination\PageMetadata;
use App\DTO\Response\Pagination\Paginator;
use Swagger\Annotations as SWG;

/**
 * Trait PageTrait
 *
 * @SWG\Definition(
 *     definition="PageTrait",
 *     type="object",
 *     required={
 *         "metadata"
 *     }
 * )
 */
trait PageTrait
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * @var PageMetadata
     *
     * @SWG\Property(
     *     type="array",
     *     @SWG\Items(
     *          @SWG\Property(property="current_page_number", type="integer"),
     *          @SWG\Property(property="total_item_count", type="integer"),
     *          @SWG\Property(property="per_page", type="integer"),
     *     ),
     *     description="Pagination metadata."
     * )
     */
    private $metadata;

    /**
     * Paginate.
     *
     * @param Paginator $paginator
     */
    public function paginate(Paginator $paginator)
    {
        foreach ($paginator->getPagination()->getIterator() as $item) {
            $this->items[] = $item;
        }

        $this->metadata = new PageMetadata($paginator);
    }

    /**
     * Get Items
     *
     * @return iterable
     */
    public function getItems(): iterable
    {
        return $this->items;
    }

    /**
     * Get Metadata
     *
     * @return PageMetadata
     */
    public function getMetadata(): PageMetadata
    {
        return $this->metadata;
    }
}
