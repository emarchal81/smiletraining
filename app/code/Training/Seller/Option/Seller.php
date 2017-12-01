<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 12/1/17
 * Time: 11:59 AM
 */

namespace Training\Seller\Option;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Model\ResourceModel\Seller\CollectionFactory as SellerCollectionFactory;

class Seller extends AbstractSource
{
    /**
     * @var SellerCollectionFactory
     */
    protected $sellerCollectionFactory;

    /**
     * @var array
     */
    protected $options;

    /**
     * Seller constructor.
     * @param SellerCollectionFactory $sellerCollectionFactory
     */
    public function __construct(SellerCollectionFactory $sellerCollectionFactory)
    {

        $this->sellerCollectionFactory = $sellerCollectionFactory;
    }

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (is_null($this->options)){
            /**
             * var SellerCollection $collection
             */
            $collection = $this->sellerCollectionFactory->create();
            $collection->setOrder(SellerInterface::FIELD_NAME,$collection::SORT_ORDER_ASC);
            $this->options = $collection->load()->toOptionArray();
        }

        return $this->options;
    }
}