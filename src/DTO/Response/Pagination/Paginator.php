<?php

namespace App\DTO\Response\Pagination;

use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

/**
 * Class Paginator
 */
class Paginator
{
    /**
     * @var DoctrinePaginator
     */
    private $pagination;

    /**
     * @var integer
     */
    private $limit;

    /**
     * @var integer
     */
    private $offset;

    /**
     * Paginator constructor.
     *
     * @param DoctrinePaginator $pagination
     * @param integer           $limit
     * @param integer           $offset
     */
    public function __construct(
        DoctrinePaginator $pagination,
        int $limit = PageInterface::DEFAULT_LIMIT,
        int $offset = PageInterface::DEFAULT_LIMIT
    )
    {
        $this->pagination = $pagination;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    /**
     * Get Pagination
     *
     * @return DoctrinePaginator
     */
    public function getPagination(): DoctrinePaginator
    {
        return $this->pagination;
    }

    /**
     * Get Limit
     *
     * @return integer
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Get Offset
     *
     * @return integer
     */
    public function getOffset(): int
    {
        return $this->offset;
    }
}
