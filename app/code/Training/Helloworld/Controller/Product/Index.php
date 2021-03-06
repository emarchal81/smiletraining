<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Controller\Product;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\Result\Raw as ResultRaw;
use Magento\Framework\Exception\NotFoundException;

class Index extends Action
{
    protected $productFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param ProductFactory $productFactory
     */
    public function __construct(
        Context $context,
        ProductFactory $productFactory
    ) {
        parent::__construct($context);
        $this->productFactory = $productFactory;

    }

    /**
     * @return ResultRaw
     * @throws NotFoundException
     */
    public function execute()
    {
        $product = $this->getAskedProduct();
        if ($product === null) {
            throw new NotFoundException(__('product not found'));
        }
        /** @var ResultRaw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents('Product: '.$product->getName());
        return $result;
    }

    /**
     * @return \Magento\Catalog\Model\Product|null
     */
    protected function getAskedProduct()
    {
// get the asked id
        $productId = (int) $this->getRequest()->getParam('id');
        if (!$productId) {
            return null;
        }
// get the product
        $product = $this->productFactory->create();
        $product->getResource()->load($product, $productId);
        if (!$product->getId()) {
            return null;
        }
        return $product;
    }
}


