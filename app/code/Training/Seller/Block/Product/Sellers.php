<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 12/1/17
 * Time: 2:22 PM
 */

namespace Training\Seller\Block\Product;


use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;
use Training\Seller\Block\Seller\AbstractBlock;
use Training\Seller\Helper\Data;
use Training\Seller\Helper\Url as UrlHelper;
use Training\Seller\Model\Seller;

class Sellers extends AbstractBlock implements IdentityInterface
{
    /**
     * @var Seller[]
     */
    protected $sellers;

    /**
     * @var Data
     */
    protected $dataHelper;

    /**
     * Sellers constructor.
     * @param Context $context
     * @param Registry $registry
     * @param UrlHelper $urlHelper
     * @param Data $dataHelper
     * @param array $data
     */
    public function __construct(Context $context, Registry $registry, UrlHelper $urlHelper,Data $dataHelper, array $data = [])
    {
        parent::__construct($context, $registry, $urlHelper, $data);
        $this->dataHelper = $dataHelper;
        $product = $this->getCurrentProduct();
        if ($product) {
            $this->setData('cache_key', 'product_view_tab_sellers_' . $product->getId());
        }

    }

    /**
     * @return mixed
     */
    public function getCurrentProduct()
    {
        $currentProduct = $this->registry->registry('current_product');
        return $currentProduct;
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        $identities = [];

        $product = $this->getCurrentProduct();
        if ($product) {
            $identities = array_merge($identities, $product->getIdentities());
        }

        $sellers = $this->getProductSellers();
        foreach ($sellers as $seller) {
            $identities = array_merge($identities, $seller->getIdentities());
        }

        return $identities;
    }

    /**
     * Get the sellers attached to the current product
     *
     * @return Seller[]
     */
    public function getProductSellers()
    {
        if (is_null($this->sellers)) {
            $this->sellers = [];
            $product = $this->getCurrentProduct();
            if ($product) {
                $this->sellers = $this->dataHelper->getProductSellers($product);
            }
        }

        return $this->sellers;
    }
}