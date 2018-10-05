<?php

namespace App\DTO\Request;

/**
 * Interface RequestPaginationInterface
 */
interface RequestPaginationInterface extends RequestInterface
{
    /**
     * Get limit
     *
     * @return integer
     */
    public function getLimit(): int;

    /**
     * Get Offset
     *
     * @return integer
     */
    public function getOffset(): int;
}
