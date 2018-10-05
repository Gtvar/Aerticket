<?php

namespace App\DTO\Response\Pagination;

use Swagger\Annotations as SWG;

/**
 * Class PageMetadata
 *
 * @SWG\Definition(
 *     definition="PageMetadata",
 *     type="object",
 *     required={
 *         "current_page_number",
 *         "total_item_count",
 *         "per_page"
 *     }
 * )
 */
class PageMetadata
{
    /**
     * @var integer
     *
     * @SWG\Property(property="current_page_number", type="integer"),
     */
    private $currentPageNumber;

    /**
     * @var integer
     *
     * @SWG\Property(property="total_item_count", type="integer"),
     */
    private $totalItemCount;

    /**
     * @var integer
     *
     * @SWG\Property(property="per_page", type="integer")
     */
    private $perPage;

    /**
     * PageMetadata constructor.
     *
     * @param Paginator $paginator
     */
    public function __construct(Paginator $paginator)
    {
        $this->totalItemCount = $paginator->getPagination()->count();
        $this->perPage = $paginator->getLimit();
        $this->currentPageNumber = (int) ceil($paginator->getOffset() / $paginator->getLimit()) + 1;
    }

    /**
     * Get CurrentPageNumber
     *
     * @return integer
     */
    public function getCurrentPageNumber(): int
    {
        return $this->currentPageNumber;
    }

    /**
     * Get TotalItemCount
     *
     * @return integer
     */
    public function getTotalItemCount(): int
    {
        return $this->totalItemCount;
    }

    /**
     * Get PerPage
     *
     * @return integer
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * Get max page
     *
     * @return integer
     */
    public function getMaxPage(): int
    {
        return (int) ceil($this->getTotalItemCount() / $this->getPerPage());
    }
}
