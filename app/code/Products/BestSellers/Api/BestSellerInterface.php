<?php

namespace Products\BestSellers\Api;

interface BestSellerInterface
{
    /**
     * Returns Best Seller Collection
     *
     * @param int $pageSize
     * @return string Returns Best Seller Collection
     */
    public function get($pageSize);
}