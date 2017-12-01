<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 12/1/17
 * Time: 3:19 PM
 */

namespace Training\Seller\Model\Product\Seller;


use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Training\Seller\Helper\Data;

class ReadHandler implements ExtensionInterface
{
    /**
     * @var Data
     */
    protected $dataHelper;

    /**
     * ReadHandler constructor.
     * @param Data $dataHelper
     */
    public function __construct(Data $dataHelper)
    {
        $this->dataHelper = $dataHelper;
    }

    /**
     * Perform action on relation/extension attribute
     *
     * @param ProductInterface $product
     * @param array $arguments
     * @return ProductInterface
     */
    public function execute($product, $arguments = [])
    {
        if ($product->getExtensionAttributes()->getSellers() !== null) {
            return $product;
        }
        $sellers = $this->dataHelper->getProductSellers($product);

        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setSellers($sellers);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;

    }
}