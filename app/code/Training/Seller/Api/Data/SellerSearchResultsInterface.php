<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/29/17
 * Time: 10:21 AM
 */

namespace Training\Seller\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for seller search results.
 * @api
 */
interface SellerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get seller list.
     *
     * @return \Training\Seller\Api\Data\SellerInterface[]
     */
    public function getItems();

    /**
     * Set seller list.
     *
     * @param \Training\Seller\Api\Data\SellerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
