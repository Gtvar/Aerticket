<?php

namespace App\DTO\Response\Pagination;

/**
 * Interface PageInterface
 */
interface PageInterface
{
    public const DEFAULT_LIMIT = 10;
    public const DEFAULT_OFFSET = 0;
    public const DEFAULT_PAGE = 1;

    /**
     * Get Items
     *
     * @return iterable
     */
    public function getItems(): iterable;

    /**
     * Get Metadata
     *
     * @return PageMetadata
     */
    public function getMetadata(): PageMetadata;
}
