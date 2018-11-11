<?php

namespace App\DTO\Request\Traits;

use App\DTO\Response\Pagination\PageInterface;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait RequestPaginationTrait
 */
trait RequestPaginationTrait
{
    /**
     * @var int
     *
     * @SWG\Property(type="string", description="Limit.")
     *
     * @Assert\GreaterThan(value="0", message="pagination.limit.greater_than")
     */
    private $limit = PageInterface::DEFAULT_LIMIT;

    /**
     * @var int
     *
     * @SWG\Property(type="string", description="Page.")
     *
     * @Assert\GreaterThanOrEqual(value="1", message="pagination.page.greater_than_or_equal")
     */
    private $page = PageInterface::DEFAULT_PAGE;

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
        return $this->limit * ($this->page - 1);
    }

    /**
     * Get Page
     *
     * @return integer
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * Fill RequestPagination from Request
     *
     * @param Request      $request
     * @param integer|null $limit
     */
    public function fillRequestPaginationFromRequest(Request $request, $limit = PageInterface::DEFAULT_LIMIT): void
    {
        $this->limit = (int) $request->get('limit', $limit);
        $this->page = (int) $request->get('page', PageInterface::DEFAULT_PAGE);
    }
}
