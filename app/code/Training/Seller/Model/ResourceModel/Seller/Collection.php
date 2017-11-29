<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/29/17
 * Time: 11:29 AM
 */
namespace Training\Seller\Model\ResourceModel\Seller;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\Seller\Api\Data\SellerInterface;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Training\Seller\Model\Seller::class,
            \Training\Seller\Model\ResourceModel\Seller::class
        );
    }

    /**
     * Returns pairs
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray(SellerInterface::FIELD_SELLER_ID, SellerInterface::FIELD_NAME);
    }
}
